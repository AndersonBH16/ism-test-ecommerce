import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { forkJoin, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

import { CartService, CartItem } from './cart.service';
import { ProductService, Product } from '../products/products.service';
import { MatSnackBar } from "@angular/material/snack-bar";

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
    this.cartService.cartItems$.subscribe(() => {
      this.loadCart();
    });
  }

  loadCart(): void {
    const cartItems: CartItem[] = this.cartService.getCartItems();
    if (!cartItems || cartItems.length === 0) {
      this.cartProducts = [];
      this.cartQuantities = {};
      return;
    }

    const observables = cartItems.map(item =>
      this.productService.getProduct(item.id).pipe(
        map(response => {
          return { product: response.data as Product, quantity: item.quantity };
        }),
        catchError(() => of(null))
      )
    );

    forkJoin(observables).subscribe(results => {
      const validResults = results.filter(r => r !== null) as { product: Product; quantity: number }[];
      this.cartProducts = validResults.map(r => r.product);
      this.cartQuantities = {};
      validResults.forEach(r => {
        this.cartQuantities[r.product.id] = r.quantity;
      });
      this.calculateTotal();
    });
  }

  calculateTotal(): void {
    this.totalAmount = this.cartProducts.reduce((total, product) => {
      const qty = this.cartQuantities[product.id] || 1;
      const priceNum = Number(product.price);
      if (isNaN(priceNum)) return total;
      return total + priceNum * qty;
    }, 0);
  }

  getProductSubtotal(product: Product): number {
    const qty = this.cartQuantities[product.id] || 1;
    const priceNum = Number(product.price);
    return isNaN(priceNum) ? 0 : priceNum * qty;
  }

  getTotalProductsCount(): number {
    return this.cartProducts.reduce((sum, product) => {
      return sum + (this.cartQuantities[product.id] || 1);
    }, 0);
  }

  removeItem(product: Product): void {
    this.cartService.removeFromCart(product.id);
    this.snackBar.open(`${product.name} eliminado del carrito`, 'Cerrar', {
      duration: 2000
    });
  }

  clearCart(): void {
    this.cartService.clearCart();
    this.snackBar.open(`Carrito vaciado`, 'Cerrar', {
      duration: 2000
    });
  }

  formatPrice(price: any): string {
    const value = Number(price);
    if (isNaN(value)) {
      return 'S/ 0.00';
    }
    return new Intl.NumberFormat('es-PE', {
      style: 'currency',
      currency: 'PEN'
    }).format(value);
  }

  trackByProductId(index: number, product: Product): number {
    return product.id;
  }

  onImageError(event: any): void {
    event.target.src = 'assets/img/ecommerce_icon.jpg';
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
          { duration: 4000 }
        );
      }
    });
  }
}
