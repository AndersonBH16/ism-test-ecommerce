import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable} from "rxjs";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {tap} from "rxjs/operators";

export interface CartItem {
  id: number;
  name: string;
  description: string;
  price: number;
  image_url: string;
  category: any;
  quantity: number;
  subtotal: number;
}

export interface Cart {
  cart_id: number;
  items: CartItem[];
  total_items: number;
  total_amount: number;
}

export interface ApiResponse<T> {
  success: boolean;
  data: T;
  message?: string;
  error?: string;
}

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private apiUrl = 'http://localhost:8068/api';
  private cartItemsSubject = new BehaviorSubject<number>(0);
  public cartItemsCount$ = this.cartItemsSubject.asObservable();

  constructor(private http: HttpClient) {
    this.loadCartCount();
  }

  private getHeaders(): HttpHeaders {
    const token = localStorage.getItem('access_token');
    return new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });
  }

  /**
   * Obtener todos los productos del carrito
   */
  getCart(): Observable<ApiResponse<Cart>> {
    return this.http.get<ApiResponse<Cart>>(`${this.apiUrl}/cart`, {
      headers: this.getHeaders()
    }).pipe(
      tap(response => {
        if (response.success) {
          this.cartItemsSubject.next(response.data.total_items);
        }
      })
    );
  }

  /**
   * Agregar producto al carrito
   */
  addToCart(productId: number, quantity: number = 1): Observable<ApiResponse<any>> {
    const body = {
      product_id: productId,
      quantity: quantity
    };

    return this.http.post<ApiResponse<any>>(`${this.apiUrl}/cart/add`, body, {
      headers: this.getHeaders()
    }).pipe(
      tap(response => {
        if (response.success) {
          this.cartItemsSubject.next(response.data.cart_items_count);
        }
      })
    );
  }

  /**
   * Actualizar cantidad de un producto en el carrito
   */
  updateQuantity(productId: number, quantity: number): Observable<ApiResponse<any>> {
    const body = { quantity: quantity };

    return this.http.put<ApiResponse<any>>(`${this.apiUrl}/cart/update/${productId}`, body, {
      headers: this.getHeaders()
    }).pipe(
      tap(() => {
        this.loadCartCount();
      })
    );
  }

  /**
   * Eliminar producto del carrito
   */
  removeFromCart(productId: number): Observable<ApiResponse<any>> {
    return this.http.delete<ApiResponse<any>>(`${this.apiUrl}/cart/remove/${productId}`, {
      headers: this.getHeaders()
    }).pipe(
      tap(() => {
        this.loadCartCount();
      })
    );
  }

  /**
   * Vaciar todo el carrito
   */
  clearCart(): Observable<ApiResponse<any>> {
    return this.http.delete<ApiResponse<any>>(`${this.apiUrl}/cart/clear`, {
      headers: this.getHeaders()
    }).pipe(
      tap(response => {
        if (response.success) {
          this.cartItemsSubject.next(0);
        }
      })
    );
  }

  /**
   * Obtener contador de productos en el carrito
   */
  getCartCount(): Observable<ApiResponse<{count: number}>> {
    return this.http.get<ApiResponse<{count: number}>>(`${this.apiUrl}/cart/count`, {
      headers: this.getHeaders()
    });
  }

  /**
   * Cargar el contador del carrito
   */
  private loadCartCount(): void {
    this.getCartCount().subscribe({
      next: (response) => {
        if (response.success) {
          this.cartItemsSubject.next(response.data.count);
        }
      },
      error: (error) => {
        console.error('Error loading cart count:', error);
        this.cartItemsSubject.next(0);
      }
    });
  }

  /**
   * Obtener el número actual de items en el carrito (valor sincrónico)
   */
  getCurrentCartCount(): number {
    return this.cartItemsSubject.value;
  }
}
