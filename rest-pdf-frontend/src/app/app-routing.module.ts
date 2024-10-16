import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DataDisplayComponent } from './components/data-display.component'; // Verifique se o caminho está correto

const routes: Routes = [
  { path: 'data', component: DataDisplayComponent },  // Rota para o componente
  { path: '', redirectTo: '/data', pathMatch: 'full' },  // Redireciona a rota base para /data
  { path: '**', redirectTo: '/data' }  // Redireciona rotas inválidas para /data
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }