import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
  image: string;
  stock: number;
  category?: {
    id: number;
    name: string;
  };
}

export interface Category {
  id: number;
  name: string;
  description?: string;
}

export interface ApiResponse<T> {
  success: boolean;
  data: T;
  message?: string;
  error?: string;
  meta?: {
    current_page: number;
    per_page: number;
    total: number;
    last_page: number;
    from: number;
    to: number;
  };
}

export interface ProductFilters {
  page?: number;
  per_page?: number;
  search?: string;
  categories?: number[];
  sort_by?: string;
  sort_order?: 'asc' | 'desc';
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

  private buildParams(filters: ProductFilters): HttpParams {
    let params = new HttpParams();

    if (filters.page) {
      params = params.set('page', filters.page.toString());
    }

    if (filters.per_page) {
      params = params.set('per_page', filters.per_page.toString());
    }

    if (filters.search && filters.search.trim()) {
      params = params.set('search', filters.search.trim());
    }

    if (filters.categories && filters.categories.length > 0) {
      filters.categories.forEach(categoryId => {
        params = params.append('categories[]', categoryId.toString());
      });
    }

    if (filters.sort_by) {
      params = params.set('sort_by', filters.sort_by);
    }

    if (filters.sort_order) {
      params = params.set('sort_order', filters.sort_order);
    }

    return params;
  }

  getProducts(filters: ProductFilters = {}): Observable<ApiResponse<Product[]>> {
    const params = this.buildParams(filters);

    return this.http.get<ApiResponse<Product[]>>(`${this.apiUrl}/products`, {
      headers: this.getHeaders(),
      params: params
    });
  }

  getProduct(id: number): Observable<ApiResponse<Product>> {
    return this.http.get<ApiResponse<Product>>(`${this.apiUrl}/products/${id}`, {
      headers: this.getHeaders()
    });
  }

  getCategories(): Observable<ApiResponse<Category[]>> {
    return this.http.get<ApiResponse<Category[]>>(`${this.apiUrl}/categories`, {
      headers: this.getHeaders()
    });
  }
}
