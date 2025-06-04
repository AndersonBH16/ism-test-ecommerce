import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItemsSubject = new BehaviorSubject<number[]>(this.loadCartFromLocalStorage());
  public cartItems$ = this.cartItemsSubject.asObservable();

  constructor() {}

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
}
