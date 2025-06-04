import {Component, OnInit} from '@angular/core';
import {Product, ProductService} from "../products.service";
import {MatSnackBar} from "@angular/material/snack-bar";

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  products: Product[] = [];
  loading = true;
  error = '';

  constructor(
    private productService: ProductService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.loadProducts();
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

  addToCart(product: Product): void {
    this.productService.addToCart(product.id, 1).subscribe({
      next: (response) => {
        this.showMessage(`${product.name} agregado al carrito`);
      },
      error: (error) => {
        console.error('Error:', error);
        this.showMessage('Error al agregar al carrito');
      }
    });
  }

  addToWishlist(product: Product): void {
    this.productService.addToWishlist(product.id).subscribe({
      next: (response) => {
        this.showMessage(`${product.name} agregado a favoritos`);
      },
      error: (error) => {
        console.error('Error:', error);
        this.showMessage('Error al agregar a favoritos');
      }
    });
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
      verticalPosition: 'top'
    });
  }

  formatPrice(price: number): string {
    return new Intl.NumberFormat('es-PE', {
      style: 'currency',
      currency: 'PEN'
    }).format(price);
  }
}
