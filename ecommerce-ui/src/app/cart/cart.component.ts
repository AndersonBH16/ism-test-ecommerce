import { Component, OnInit } from '@angular/core';
import { CartService, Cart, CartItem } from '../cart.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog';
import {ConfirmDialogComponent} from "../confirm-dialog/confirm-dialog.component";

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cart: Cart | null = null;
  loading = true;
  error = '';

  constructor(
    private cartService: CartService,
    private snackBar: MatSnackBar,
    private dialog: MatDialog
  ) {}

  ngOnInit(): void {
    this.loadCart();
  }

  loadCart(): void {
    this.loading = true;
    this.error = '';

    this.cartService.getCart().subscribe({
      next: (response) => {
        if (response.success) {
          this.cart = response.data;
        } else {
          this.error = response.message || 'Error al cargar el carrito';
        }
        this.loading = false;
      },
      error: (error) => {
        console.error('Error:', error);
        this.error = 'Error al conectar con el servidor';
        this.loading = false;
        this.showMessage('Error al cargar el carrito');
      }
    });
  }

  updateQuantity(item: CartItem, newQuantity: number): void {
    if (newQuantity < 1) {
      this.removeItem(item);
      return;
    }

    this.cartService.updateQuantity(item.id, newQuantity).subscribe({
      next: (response) => {
        if (response.success) {
          // Actualizar la cantidad localmente
          item.quantity = newQuantity;
          item.subtotal = item.price * newQuantity;
          this.recalculateTotal();
          this.showMessage('Cantidad actualizada');
        } else {
          this.showMessage(response.message || 'Error al actualizar cantidad');
        }
      },
      error: (error) => {
        console.error('Error:', error);
        this.showMessage('Error al actualizar cantidad');
      }
    });
  }

  removeItem(item: CartItem): void {
    this.cartService.removeFromCart(item.id).subscribe({
      next: (response) => {
        if (response.success) {
          if (this.cart) {
            this.cart.items = this.cart.items.filter(cartItem => cartItem.id !== item.id);
            this.recalculateTotal();
          }
          this.showMessage(`${item.name} eliminado del carrito`);
        } else {
          this.showMessage(response.message || 'Error al eliminar producto');
        }
      },
      error: (error) => {
        console.error('Error:', error);
        this.showMessage('Error al eliminar producto');
      }
    });
  }

  clearCart(): void {
    if (!this.cart || this.cart.items.length === 0) {
      return;
    }

    const dialogRef = this.dialog.open(ConfirmDialogComponent, {
      width: '350px',
      data: {
        title: 'Vaciar Carrito',
        message: '¿Estás seguro de que quieres vaciar todo el carrito?',
        confirmText: 'Vaciar',
        cancelText: 'Cancelar'
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.cartService.clearCart().subscribe({
          next: (response) => {
            if (response.success) {
              this.cart = {
                cart_id: this.cart!.cart_id,
                items: [],
                total_items: 0,
                total_amount: 0
              };
              this.showMessage('Carrito vaciado');
            } else {
              this.showMessage(response.message || 'Error al vaciar el carrito');
            }
          },
          error: (error) => {
            console.error('Error:', error);
            this.showMessage('Error al vaciar el carrito');
          }
        });
      }
    });
  }

  private recalculateTotal(): void {
    if (this.cart) {
      this.cart.total_items = this.cart.items.reduce((sum, item) => sum + item.quantity, 0);
      this.cart.total_amount = this.cart.items.reduce((sum, item) => sum + item.subtotal, 0);
    }
  }

  increaseQuantity(item: CartItem): void {
    this.updateQuantity(item, item.quantity + 1);
  }

  decreaseQuantity(item: CartItem): void {
    if (item.quantity > 1) {
      this.updateQuantity(item, item.quantity - 1);
    } else {
      this.removeItem(item);
    }
  }

  onImageError(event: Event): void {
    const target = event.target as HTMLImageElement;
    if (target) {
      target.src = 'assets/img/ecommerce_icon.jpg';
    }
  }

  formatPrice(price: number): string {
    return new Intl.NumberFormat('es-PE', {
      style: 'currency',
      currency: 'PEN'
    }).format(price);
  }

  trackByItemId(index: number, item: CartItem): number {
    return item.id;
  }

  private showMessage(message: string): void {
    this.snackBar.open(message, 'Cerrar', {
      duration: 3000,
      horizontalPosition: 'right',
      verticalPosition: 'top'
    });
  }

  proceedToCheckout(): void {
    if (!this.cart || this.cart.items.length === 0) {
      this.showMessage('El carrito está vacío');
      return;
    }

    // Aquí implementarías la lógica para proceder al checkout
    this.showMessage('Funcionalidad de checkout pendiente de implementar');
  }
}
