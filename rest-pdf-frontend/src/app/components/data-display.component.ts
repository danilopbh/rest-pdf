import { Component, OnInit, TemplateRef } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service'; // Ajuste o caminho conforme necessário
import { DataModel } from '../store/data.model'; // Ajuste o caminho conforme necessário
import { NgIfContext } from '@angular/common';
import { PageEvent } from '@angular/material/paginator';

@Component({
  selector: 'app-data-display',
  templateUrl: './data-display.component.html',
  styleUrls: ['./data-display.component.scss']
})
export class DataDisplayComponent implements OnInit {
  data$!: Observable<DataModel | null>;
  loading!: TemplateRef<NgIfContext<DataModel|null>>|null;
  pageSize = 5; //Número de itens por página
  pageIndex = 0; //Indice da página atual
  lengthSupp = 0; //Total de itens de cda_supp e contribuinte_supp
  lengthSiatu = 0 //Total de itens de cda_siatu e contribuinte_siatu

  //Para mostrar/esconder partes dos dados
  showCdaSupp = true;
  showContribuinteSupp = true;
  showCdaSiatu = true;
  showContribuinteSiatu = true;

  constructor(private dataService: DataService) {}

  ngOnInit(): void {
    console.log('DataDisplayComponent initialized');
    this.data$ = this.dataService.getData(); // Buscar os dados da API
    // Aqui você pode definir a lógica para contar o número total de itens
    // Se os dados estiverem carregados
    this.data$.subscribe( data => {
      if (data) {
        this.lengthSupp = data.cda_supp.length + data.contribuinte_supp.length;
        this.lengthSiatu = data.cda_siatu.length + data.contribuinte_siatu.length;
      }
    });
  }

  onPageChange(event: {pageIndex: number; pageSize: number}): void {
    this.pageIndex = event.pageIndex;
    this.pageSize = event.pageSize;
  }
}