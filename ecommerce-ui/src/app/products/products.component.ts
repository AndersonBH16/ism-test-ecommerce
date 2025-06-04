import { Component, OnInit } from '@angular/core';
import { Product, ProductService } from "../products.service";
import { MatSnackBar } from "@angular/material/snack-bar";
import { CartService} from "../cart.service";

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  products: Product[] = [];
  loading = true;
  error = '';
  cartProductIds: number[] = [];

  constructor(
    private productService: ProductService,
    private cartService: CartService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.loadProducts();

    this.cartService.cartItems$.subscribe((ids: number[]) => {
      this.cartProductIds = ids;
    });
  }

  loadProducts(): void {
    this.loading = true;
    this.productService.getAllProducts().subscribe({
      next: (response) => {
        if (response.success) {
          this.products = response.data;
        } else {
          this.error = 'Error al cargar los productos';
        }
        this.loading = false;
      },
      error: (error) => {
        console.error('Error:', error);
        this.error = 'Error al conectar con el servidor';
        this.loading = false;
        this.showMessage('Error al cargar los productos');
      }
    });
  }

  isInCart(product: Product): boolean {
    return this.cartProductIds.includes(product.id);
  }

  toggleCart(product: Product): void {
    if (this.isInCart(product)) {
      this.cartService.removeFromCart(product.id);
      this.showMessage(`${product.name} eliminado del carrito`);
    } else {
      this.cartService.addToCart(product.id);
      this.showMessage(`${product.name} agregado al carrito`);
    }
  }

  onImageError(event: Event): void {
    const target = event.target as HTMLImageElement;
    if (target) {
      target.src = 'assets/img/ecommerce_icon.jpg';
    }
  }

  private showMessage(message: string): void {
    this.snackBar.open(message, 'Cerrar', {
      duration: 3000,
      horizontalPosition: 'right',
      verticalPosition: 'bottom'
    });
  }

  formatPrice(price: number): string {
    return new Intl.NumberFormat('es-PE', {
      style: 'currency',
      currency: 'PEN'
    }).format(price);
  }
}
