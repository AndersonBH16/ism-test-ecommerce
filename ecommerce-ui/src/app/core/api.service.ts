import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, tap } from 'rxjs';

interface LoginResponse {
  access_token: string;
  token_type: string;
  expires_in: number;
}

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private apiUrl = 'http://localhost:8068/api/auth';

  constructor(private http: HttpClient) {}

  getProducts(): Observable<any> {
    return this.http.get(`${this.apiUrl}/products`);
  }

  getProduct(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/products/${id}`);
  }

  getCart(): Observable<any> {
    return this.http.get(`${this.apiUrl}/cart`);
  }

  addToCart(productId: number, quantity: number = 1): Observable<any> {
    return this.http.post(`${this.apiUrl}/cart`, {
      product_id: productId,
      quantity
    });
  }

  removeFromCart(productId: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/cart/${productId}`);
  }

  checkout(): Observable<any> {
    return this.http.post(`${this.apiUrl}/orders`, {});
  }

  getOrders(): Observable<any> {
    return this.http.get(`${this.apiUrl}/orders`);
  }

  getOrder(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/orders/${id}`);
  }
}
