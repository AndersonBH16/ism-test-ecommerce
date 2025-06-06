// src/app/cart.service.ts
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
  // Inicializamos el BehaviorSubject con el resultado de loadCartFromLocalStorage()
  private cartItemsSubject = new BehaviorSubject<CartItem[]>(this.loadCartFromLocalStorage());
  public cartItems$ = this.cartItemsSubject.asObservable();
  private apiUrl = 'http://localhost:8068/api';

  constructor(private http: HttpClient) {}

  /**
   * Lee del localStorage la clave 'cart' y devuelve un array de CartItem.
   * Si detecta un array de números (shape antiguo), lo convierte a CartItem[] con quantity=1.
   */
  private loadCartFromLocalStorage(): CartItem[] {
    const storedCart = localStorage.getItem('cart');
    if (!storedCart) {
      return [];
    }

    try {
      const parsed = JSON.parse(storedCart);
      // Si parsed es un array de números (legacy), lo convertimos.
      if (Array.isArray(parsed) && parsed.length > 0 && typeof parsed[0] === 'number') {
        return (parsed as number[]).map(id => ({ id, quantity: 1 }));
      }
      // Si parsed es ya un array de objetos {id, quantity}
      return parsed as CartItem[];
    } catch {
      // Si el JSON está corrupto, devolvemos carrito vacío
      return [];
    }
  }

  /**
   * Actualiza el localStorage y el BehaviorSubject con el nuevo array de CartItem[].
   */
  private updateCart(cart: CartItem[]): void {
    localStorage.setItem('cart', JSON.stringify(cart));
    this.cartItemsSubject.next(cart);
  }

  /**
   * Verifica si un producto (por su ID) ya está en el carrito.
   */
  isInCart(productId: number): boolean {
    return this.cartItemsSubject.value.some(item => item.id === productId);
  }

  /**
   * Agrega un producto al carrito o actualiza su cantidad si ya existía.
   * @param productId ID del producto a agregar/actualizar
   * @param quantity Cantidad elegida (entera, ≥ 1)
   */
  addToCart(productId: number, quantity: number = 1): void {
    const currentCart = this.cartItemsSubject.value;
    const existing = currentCart.find(item => item.id === productId);

    if (!existing) {
      // Si no existía antes, lo agregamos con { id, quantity }
      const updatedCart = [...currentCart, { id: productId, quantity }];
      this.updateCart(updatedCart);
    } else {
      // Si ya estaba, simplemente actualizamos su cantidad
      existing.quantity = quantity;
      this.updateCart([...currentCart]);
    }
  }

  /**
   * Actualiza la cantidad de un producto que ya está en el carrito.
   */
  updateQuantity(productId: number, quantity: number): void {
    const currentCart = this.cartItemsSubject.value;
    const existing = currentCart.find(item => item.id === productId);

    if (existing) {
      existing.quantity = quantity;
      this.updateCart([...currentCart]);
    }
  }

  /**
   * Elimina un producto del carrito (por su ID).
   */
  removeFromCart(productId: number): void {
    const updatedCart = this.cartItemsSubject.value.filter(item => item.id !== productId);
    this.updateCart(updatedCart);
  }

  /**
   * Vacía por completo el carrito.
   */
  clearCart(): void {
    this.updateCart([]);
  }

  /**
   * Devuelve el array completo de CartItem {id, quantity}.
   */
  getCartItems(): CartItem[] {
    return this.cartItemsSubject.value;
  }

  /**
   * Envía al backend la orden de compra con los productos y sus cantidades.
   */
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
