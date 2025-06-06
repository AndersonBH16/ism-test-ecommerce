import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';

export interface CartItem {
  id: number;
  quantity: number;
}

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItemsSubject = new BehaviorSubject<CartItem[]>(this.loadCartFromLocalStorage());
  public cartItems$ = this.cartItemsSubject.asObservable();
  private apiUrl = 'http://localhost:8068/api';

  constructor(private http: HttpClient) {}

  private loadCartFromLocalStorage(): CartItem[] {
    const storedCart = localStorage.getItem('cart');
    if (!storedCart) {
      return [];
    }

    try {
      const parsed = JSON.parse(storedCart);
      if (Array.isArray(parsed) && parsed.length > 0 && typeof parsed[0] === 'number') {
        return (parsed as number[]).map(id => ({ id, quantity: 1 }));
      }
      return parsed as CartItem[];
    } catch {
      return [];
    }
  }

  private updateCart(cart: CartItem[]): void {
    localStorage.setItem('cart', JSON.stringify(cart));
    this.cartItemsSubject.next(cart);
  }

  isInCart(productId: number): boolean {
    return this.cartItemsSubject.value.some(item => item.id === productId);
  }

  addToCart(productId: number, quantity: number = 1): void {
    const currentCart = this.cartItemsSubject.value;
    const existing = currentCart.find(item => item.id === productId);

    if (!existing) {
      const updatedCart = [...currentCart, { id: productId, quantity }];
      this.updateCart(updatedCart);
    } else {
      existing.quantity = quantity;
      this.updateCart([...currentCart]);
    }
  }

  updateQuantity(productId: number, quantity: number): void {
    const currentCart = this.cartItemsSubject.value;
    const existing = currentCart.find(item => item.id === productId);

    if (existing) {
      existing.quantity = quantity;
      this.updateCart([...currentCart]);
    }
  }

  removeFromCart(productId: number): void {
    const updatedCart = this.cartItemsSubject.value.filter(item => item.id !== productId);
    this.updateCart(updatedCart);
  }

  clearCart(): void {
    this.updateCart([]);
  }

  getCartItems(): CartItem[] {
    return this.cartItemsSubject.value;
  }

  createOrder(products: { id: number; quantity: number }[]): Observable<any> {
    const token = localStorage.getItem('token') || '';
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });
    const body = { products };
    return this.http.post(`${this.apiUrl}/orders`, body, { headers });
  }
}
