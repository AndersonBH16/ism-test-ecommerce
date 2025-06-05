import { Component, OnInit, OnDestroy } from '@angular/core';
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
  products: Product[] = [];
  categories: Category[] = [];
  selectedCategories: number[] = [];
  searchControl = new FormControl('');

  // --- Ordenamiento ---
  sortBy = 'created_at';                   // valor inicial por defecto
  sortOrder: 'asc' | 'desc' = 'desc';      // valor inicial por defecto

  loading = true;
  error = '';

  // --- Paginación clásica ---
  currentPage = 1;
  perPage = 12;
  lastPage = 1;
  totalProducts = 0;

  cartProductIds: number[] = [];
  private destroy$ = new Subject<void>();

  // Opciones de orden que mostramos en la vista
  availableSortFields = [
    { value: 'name', display: 'Nombre' },
    { value: 'price', display: 'Precio' },
    { value: 'created_at', display: 'Fecha creación' },
    { value: 'updated_at', display: 'Fecha actualización' }
  ];

  availableSortOrders = [
    { value: 'asc', display: 'Ascendente' },
    { value: 'desc', display: 'Descendente' }
  ];

  constructor(
    private productService: ProductService,
    private cartService: CartService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    console.log('🚀 Iniciando ProductsComponent con ordenamiento + paginación');
    this.loadCategories();
    this.loadProducts(true);
    this.setupSearch();
    this.setupCartSubscription();
  }

  ngOnDestroy(): void {
    this.destroy$.next();
    this.destroy$.complete();
  }

  setupSearch(): void {
    this.searchControl.valueChanges
      .pipe(
        debounceTime(300),
        distinctUntilChanged(),
        takeUntil(this.destroy$)
      )
      .subscribe(() => {
        this.goToPage(1);
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
        console.error('Error al cargar categorías', error);
      }
    });
  }

  loadProducts(reset: boolean = false): void {
    if (reset) {
      this.loading = true;
      this.error = '';
    }

    const params = {
      page: this.currentPage,
      per_page: this.perPage,
      search: this.searchControl.value || '',
      categories:
        this.selectedCategories.length > 0
          ? this.selectedCategories
          : undefined,
      sort_by: this.sortBy,
      sort_order: this.sortOrder
    };

    console.log('📤 Petición con parámetros:', params);

    this.productService.getProducts(params).subscribe({
      next: (response) => {
        console.log('📥 Respuesta API:', response);

        if (response.success) {
          this.products = response.data;

          if (response.meta) {
            this.totalProducts = response.meta.total;
            this.lastPage = response.meta.last_page;
          } else {
            this.lastPage = 1;
          }
        } else {
          this.error = response.message || 'Error al cargar productos';
        }

        this.loading = false;
      },
      error: (error) => {
        console.error('❌ Error de conexión:', error);
        this.error = 'Error al conectar con el servidor';
        this.loading = false;
        this.showMessage('Error al cargar los productos');
      }
    });
  }

  // Navegación entre páginas
  goToPage(page: number): void {
    if (page < 1 || page > this.lastPage) {
      return;
    }
    this.currentPage = page;
    this.loadProducts(true);
  }

  prevPage(): void {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.loadProducts(true);
    }
  }

  nextPage(): void {
    if (this.currentPage < this.lastPage) {
      this.currentPage++;
      this.loadProducts(true);
    }
  }

  // Se invoca cuando cambia el campo de orden
  onSortByChange(newSortBy: string): void {
    this.sortBy = newSortBy;
    this.goToPage(1);
  }

  // Se invoca cuando cambia la dirección del orden
  onSortOrderChange(newSortOrder: 'asc' | 'desc'): void {
    this.sortOrder = newSortOrder;
    this.goToPage(1);
  }

  onCategoryChange(categoryId: number, selected: boolean): void {
    if (selected) {
      if (!this.selectedCategories.includes(categoryId)) {
        this.selectedCategories.push(categoryId);
      }
    } else {
      this.selectedCategories = this.selectedCategories.filter(
        (id) => id !== categoryId
      );
    }
    this.goToPage(1);
  }

  clearAllFilters(): void {
    this.searchControl.setValue('');
    this.selectedCategories = [];
    this.goToPage(1);
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
