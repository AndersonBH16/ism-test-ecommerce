import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
  image_url: string;
  category?: {
    id: number;
    name: string;
  };
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
export class ProductService {
  private apiUrl = 'http://localhost:8068/api';

  constructor(private http: HttpClient) {}

  private getHeaders(): HttpHeaders {
    const token = localStorage.getItem('access_token');
    return new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });
  }

  getAllProducts(): Observable<ApiResponse<Product[]>> {
    return this.http.get<ApiResponse<Product[]>>(`${this.apiUrl}/products`, {
      headers: this.getHeaders()
    });
  }

  addToCart(productId: number, quantity: number = 1): Observable<ApiResponse<any>> {
    const body = {
      product_id: productId,
      quantity: quantity
    };

    return this.http.post<ApiResponse<any>>(`${this.apiUrl}/cart/add`, body, {
      headers: this.getHeaders()
    });
  }

  addToWishlist(productId: number): Observable<ApiResponse<any>> {
    const body = {
      product_id: productId
    };

    return this.http.post<ApiResponse<any>>(`${this.apiUrl}/wishlist/add`, body, {
      headers: this.getHeaders()
    });
  }
}
