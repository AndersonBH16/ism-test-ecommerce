import { Component, OnInit, OnDestroy, HostListener, ElementRef, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { Product, ProductService, Category } from "../products.service";
import { MatSnackBar } from "@angular/material/snack-bar";
import { CartService } from "../cart.service";
import { debounceTime, distinctUntilChanged, Subject, takeUntil } from 'rxjs';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit, OnDestroy {
  @ViewChild('searchInput') searchInput!: ElementRef;

  products: Product[] = [];
  categories: Category[] = [];
  selectedCategories: number[] = [];
  searchControl = new FormControl('');

  loading = true;
  loadingMore = false;
  error = '';
  hasMoreProducts = true;

  // Paginación
  currentPage = 1;
  perPage = 12;
  totalProducts = 0;

  cartProductIds: number[] = [];

  private destroy$ = new Subject<void>();

  constructor(
    private productService: ProductService,
    private cartService: CartService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.loadCategories();
    this.loadProducts();
    this.setupSearch();
    this.setupCartSubscription();
  }

  ngOnDestroy(): void {
    this.destroy$.next();
    this.destroy$.complete();
  }

  @HostListener('window:scroll', ['$event'])
  onScroll(): void {
    if (this.loading || this.loadingMore || !this.hasMoreProducts) return;

    const scrollPosition = window.pageYOffset + window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;

    // Cargar más cuando esté cerca del final (200px antes)
    if (scrollPosition >= documentHeight - 200) {
      this.loadMoreProducts();
    }
  }

  setupSearch(): void {
    this.searchControl.valueChanges
      .pipe(
        debounceTime(300),
        distinctUntilChanged(),
        takeUntil(this.destroy$)
      )
      .subscribe(() => {
        this.resetAndSearch();
      });
  }

  setupCartSubscription(): void {
    this.cartService.cartItems$
      .pipe(takeUntil(this.destroy$))
      .subscribe((ids: number[]) => {
        this.cartProductIds = ids;
      });
  }

  loadCategories(): void {
    this.productService.getCategories().subscribe({
      next: (response) => {
        if (response.success) {
          this.categories = response.data;
        }
      },
      error: (error) => {
        console.error('Error al cargar categorías:', error);
      }
    });
  }

  loadProducts(reset: boolean = true): void {
    if (reset) {
      this.loading = true;
      this.currentPage = 1;
      this.products = [];
      this.hasMoreProducts = true;
    } else {
      this.loadingMore = true;
    }

    const params = {
      page: this.currentPage,
      per_page: this.perPage,
      search: this.searchControl.value || '',
      categories: this.selectedCategories.length > 0 ? this.selectedCategories : undefined
    };

    this.productService.getProducts(params).subscribe({
      next: (response) => {
        if (response.success) {
          if (reset) {
            this.products = response.data;
          } else {
            this.products = [...this.products, ...response.data];
          }

          // Actualizar información de paginación
          if (response.meta) {
            this.totalProducts = response.meta.total;
            this.hasMoreProducts = this.currentPage < response.meta.last_page;
          } else {
            // Si no hay meta, asumir que no hay más productos si recibimos menos del límite
            this.hasMoreProducts = response.data.length === this.perPage;
          }
        } else {
          this.error = response.message || 'Error al cargar los productos';
        }

        this.loading = false;
        this.loadingMore = false;
      },
      error: (error) => {
        console.error('Error:', error);
        this.error = 'Error al conectar con el servidor';
        this.loading = false;
        this.loadingMore = false;
        this.showMessage('Error al cargar los productos');
      }
    });
  }

  loadMoreProducts(): void {
    if (!this.hasMoreProducts || this.loadingMore) return;

    this.currentPage++;
    this.loadProducts(false);
  }

  resetAndSearch(): void {
    this.currentPage = 1;
    this.loadProducts(true);
  }

  onCategoryChange(categoryId: number, selected: boolean): void {
    if (selected) {
      if (!this.selectedCategories.includes(categoryId)) {
        this.selectedCategories.push(categoryId);
      }
    } else {
      this.selectedCategories = this.selectedCategories.filter(id => id !== categoryId);
    }

    this.resetAndSearch();
  }

  clearAllFilters(): void {
    this.searchControl.setValue('');
    this.selectedCategories = [];
    this.resetAndSearch();
  }

  retryLoad(): void {
    this.error = '';
    this.loadProducts(true);
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

  trackByProductId(index: number, product: Product): number {
    return product.id;
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
