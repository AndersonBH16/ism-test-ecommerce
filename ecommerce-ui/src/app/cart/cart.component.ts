// src/app/cart/cart.component.ts
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { forkJoin, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

import { CartService } from '../cart.service';
import { ProductService, Product } from '../products.service';
import {MatSnackBar} from "@angular/material/snack-bar";

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cartProducts: Product[] = [];
  loading = false;
  totalAmount = 0;

  cartQuantities: { [productId: number]: number } = {};

  constructor(
    private router: Router,
    private cartService: CartService,
    private productService: ProductService,
    private snackBar: MatSnackBar,
  ) {}

  ngOnInit(): void {
    this.loadCart();
  }

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

      this.cartProducts.forEach(prod => {
        if (this.cartQuantities[prod.id] === undefined) {
          this.cartQuantities[prod.id] = 1;
        }
      });

      this.calculateTotal();
      this.loading = false;
    });
  }

  calculateTotal(): void {
    this.totalAmount = this.cartProducts.reduce((total, product) => {
      const qty = this.cartQuantities[product.id] || 1;
      const priceNum = Number(product.price);
      return isNaN(priceNum) ? total : total + priceNum * qty;
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

  increaseCartQuantity(product: Product): void {
    if (this.cartQuantities[product.id] < product.stock) {
      this.cartQuantities[product.id]++;
      this.calculateTotal();
    }
  }

  decreaseCartQuantity(product: Product): void {
    if (this.cartQuantities[product.id] > 1) {
      this.cartQuantities[product.id]--;
      this.calculateTotal();
    }
  }

  createOrderProducts(): void {
    if (this.cartProducts.length === 0) {
      return;
    }

    const payload = this.cartProducts.map(prod => ({
      id: prod.id,
      quantity: this.cartQuantities[prod.id] || 1
    }));

    this.cartService.createOrder(payload).subscribe({
      next: (response) => {
        if (response.success) {
          this.snackBar.open('¡Pedido registrado exitosamente!', 'Cerrar', {
            duration: 3000,
            horizontalPosition: 'right',
            verticalPosition: 'bottom'
          });
          this.cartService.clearCart();
          this.cartProducts = [];
          this.cartQuantities = {};
          this.totalAmount = 0;
          // (Opcional) Redirigir a “Mis Pedidos”:
          // this.router.navigate(['/home/mis-pedidos']);
        } else {
          this.snackBar.open('Error al registrar el pedido', 'Cerrar', {
            duration: 3000
          });
        }
      },
      error: (err) => {
        console.error('Error al crear pedido:', err);
        this.snackBar.open(
          'Ocurrió un error al procesar tu pedido. Intenta nuevamente.',
          'Cerrar',
          {duration: 4000}
        );
      }
    });
  }
}
