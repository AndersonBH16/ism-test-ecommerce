import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable} from 'rxjs';
import {HttpClient, HttpHeaders} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItemsSubject = new BehaviorSubject<number[]>(this.loadCartFromLocalStorage());
  public cartItems$ = this.cartItemsSubject.asObservable();
  private apiUrl = 'http://localhost:8068/api';

  constructor(private http: HttpClient) {}

  private loadCartFromLocalStorage(): number[] {
    const storedCart = localStorage.getItem('cart');
    return storedCart ? JSON.parse(storedCart) : [];
  }

  private updateCart(cart: number[]): void {
    localStorage.setItem('cart', JSON.stringify(cart));
    this.cartItemsSubject.next(cart);
  }

  addToCart(productId: number): void {
    const currentCart = this.cartItemsSubject.value;
    if (!currentCart.includes(productId)) {
      const updatedCart = [...currentCart, productId];
      this.updateCart(updatedCart);
    }
  }

  removeFromCart(productId: number): void {
    const updatedCart = this.cartItemsSubject.value.filter(id => id !== productId);
    this.updateCart(updatedCart);
  }

  clearCart(): void {
    this.updateCart([]);
  }

  getCartItems(): number[] {
    return this.cartItemsSubject.value;
  }

  createOrder(products: { id: number; quantity: number }[]): Observable<any> {
    const token = localStorage.getItem('token') || '';
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });

    const body = { products: products };

    return this.http.post(`${this.apiUrl}/orders`, body, { headers: headers });
  }
}
