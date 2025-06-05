// src/app/cart/cart.component.ts
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { forkJoin, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

import { CartService } from '../cart.service';
import { ProductService, Product } from '../products.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cartProducts: Product[] = [];
  loading = false;
  totalAmount = 0;

  constructor(
    private router: Router,
    private cartService: CartService,
    private productService: ProductService
  ) {}

  ngOnInit(): void {
    this.loadCart();
  }

  /**
   * Carga de forma dinámica los productos cuyo ID esté en el carrito.
   */
  loadCart(): void {
    this.loading = true;
    const productIds = this.cartService.getCartItems();

    if (!productIds || productIds.length === 0) {
      this.cartProducts = [];
      this.totalAmount = 0;
      this.loading = false;
      return;
    }

    const observables = productIds.map(id =>
      this.productService.getProduct(id).pipe(
        map(response => response.data),
        catchError(() => of(null))
      )
    );

    forkJoin(observables).subscribe(results => {
      this.cartProducts = (results.filter(prod => prod !== null) as Product[]);
      this.calculateTotal();
      this.loading = false;
    });
  }

  calculateTotal(): void {
    this.totalAmount = this.cartProducts.reduce((total, product) => {
      const priceNum = Number(product.price);
      return isNaN(priceNum) ? total : total + priceNum;
    }, 0);
  }

  removeItem(product: Product): void {
    this.cartService.removeFromCart(product.id);
    this.cartProducts = this.cartProducts.filter(p => p.id !== product.id);
    this.calculateTotal();
  }

  clearCart(): void {
    this.cartService.clearCart();
    this.cartProducts = [];
    this.totalAmount = 0;
  }

  formatPrice(price: any): string {
    const value = Number(price);
    if (isNaN(value)) {
      return 'S/ 0.00';
    }
    return `S/ ${value.toFixed(2)}`;
  }

  trackByProductId(index: number, product: Product): number {
    return product.id;
  }

  onImageError(event: any): void {
    event.target.src = 'assets/img/ecommerce_icon.jpg';
  }

  proceedToCheckout(): void {
    if (this.cartProducts.length > 0) {
      this.router.navigate(['/checkout']);
    }
  }
}
