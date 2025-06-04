import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  cartProducts: any[] = [];
  loading = false;
  totalAmount = 0;

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.loadCart();
  }

  loadCart(): void {
    this.loading = true;
    // Simular carga de datos del carrito
    // Aquí deberías cargar los productos desde tu servicio
    setTimeout(() => {
      // Ejemplo de datos
      this.cartProducts = [
        {
          id: 1,
          name: 'Televisor Smart 50"',
          description: 'Producto de la categoría...',
          price: 12.30,
          image_url: 'assets/images/tv.jpg',
          category: { name: 'Electrónicos' }
        },
        {
          id: 2,
          name: 'Audífonos Bluetooth',
          description: 'Producto de la categoría...',
          price: 14.60,
          image_url: 'assets/images/headphones.jpg',
          category: { name: 'Audio' }
        },
        {
          id: 3,
          name: 'Laptop Dell Inspiron',
          description: 'Producto de la categoría...',
          price: 16.90,
          image_url: 'assets/images/laptop.jpg',
          category: { name: 'Computadoras' }
        }
      ];

      this.calculateTotal();
      this.loading = false;
    }, 1000);
  }

  calculateTotal(): void {
    this.totalAmount = this.cartProducts.reduce((total, product) => {
      return total + (product.price || 0);
    }, 0);
  }

  removeItem(product: any): void {
    const index = this.cartProducts.findIndex(p => p.id === product.id);
    if (index > -1) {
      this.cartProducts.splice(index, 1);
      this.calculateTotal();
    }
  }

  clearCart(): void {
    this.cartProducts = [];
    this.calculateTotal();
  }

  formatPrice(price: number): string {
    if (price === null || price === undefined || isNaN(price)) {
      return 'S/ 0.00';
    }
    return `S/ ${price.toFixed(2)}`;
  }

  trackByProductId(index: number, product: any): number {
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
