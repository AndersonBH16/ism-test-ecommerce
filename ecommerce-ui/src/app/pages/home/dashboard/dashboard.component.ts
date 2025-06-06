import { Component, OnInit } from '@angular/core';
import { DashboardService, DashboardStats } from './dashboard.service';
import { MatSnackBar } from '@angular/material/snack-bar';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  stats: DashboardStats | null = null;
  loading = false;
  errorMessage = '';

  constructor(
    private dashboardService: DashboardService,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.fetchStats();
  }

  fetchStats(): void {
    this.loading = true;
    this.errorMessage = '';
    this.dashboardService.getStats().subscribe({
      next: (response) => {
        if (response.success) {
          this.stats = response.data;
        } else {
          this.errorMessage = response.message || 'Error al cargar estadísticas';
          this.openSnack(this.errorMessage);
        }
        this.loading = false;
      },
      error: (err) => {
        this.errorMessage = 'No se pudo conectar con el servidor';
        this.openSnack(this.errorMessage);
        this.loading = false;
      }
    });
  }

  openSnack(msg: string): void {
    this.snackBar.open(msg, 'Cerrar', {
      duration: 3000,
      horizontalPosition: 'right',
      verticalPosition: 'bottom'
    });
  }

  formatNumber(value: number | null): string {
    if (value === null || value === undefined) {
      return '0';
    }
    return new Intl.NumberFormat('es-PE').format(value);
  }
}
