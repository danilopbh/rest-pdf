import { Component, OnInit, TemplateRef } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service'; // Ajuste o caminho conforme necessário
import { DataModel } from '../store/data.model'; // Ajuste o caminho conforme necessário
import { MatDialog } from '@angular/material/dialog';
import { HttpClient } from '@angular/common/http';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser'; // Import DomSanitizer
import { NgIfContext } from '@angular/common';
import { PdfModalComponent } from './pdf-modal.component';

@Component({
  selector: 'app-data-display',
  templateUrl: './data-display.component.html',
  styleUrls: ['./data-display.component.scss']
})
export class DataDisplayComponent implements OnInit {
  data$!: Observable<DataModel | null>;
  loading!: TemplateRef<NgIfContext<DataModel | null>> | null;
  pageSize = 5; //Número de itens por página
  pageIndex = 0; //Indice da página atual
  lengthSupp = 0; //Total de itens de cda_supp e contribuinte_supp
  lengthSiatu = 0; //Total de itens de cda_siatu e contribuinte_siatu

  // Para mostrar/esconder partes dos dados
  showCdaSupp = true;
  showContribuinteSupp = true;
  showCdaSiatu = true;
  showContribuinteSiatu = true;

  constructor(
    private dataService: DataService,
    private http: HttpClient,
    public dialog: MatDialog,
    private sanitizer: DomSanitizer  // Injetar DomSanitizer
  ) { }

  ngOnInit(): void {
    console.log('DataDisplayComponent initialized');
    this.data$ = this.dataService.getData(); // Buscar os dados da API
    this.data$.subscribe(data => {
      if (data) {
        this.lengthSupp = (data.cda_supp.length || 0) + (data.contribuinte_supp.length || 0);
        this.lengthSiatu = (data.cda_siatu.length || 0) + (data.contribuinte_siatu.length || 0);
      }
    });
  }

  onPageChange(event: { pageIndex: number; pageSize: number }): void {
    this.pageIndex = event.pageIndex;
    this.pageSize = event.pageSize;
  }

  // Método para abrir o modal com o PDF
  openPdfModal(id: number): void {
    const pdfUrl = `/export/pdf/${id}`;

    // Faz a requisição para buscar a string base64 do PDF
    this.http.get(pdfUrl, { responseType: 'blob' }).subscribe(
      (response) => {
        //Cria um objeto URL a partir do blob
        const pdfBlobUrl = URL.createObjectURL(response);

        // Abre o modal e exibe o PDF
        this.dialog.open(PdfModalComponent, {
          width: '80%',
          height: '80%',
          data: { pdfUrl: pdfBlobUrl } // Passa a URL do PDF para o modal
        });
      },
      (error) => {
        console.error('Erro ao buscar o PDF', error);
      }
    );
  }

  // Método para converter a string Base64 para um Blob
  base64ToBlob(base64: string, contentType: string): Blob {
    const byteCharacters = atob(base64); // Decodifica a string Base64
    const byteNumbers = new Array(byteCharacters.length);

    for (let i = 0; i < byteCharacters.length; i++) {
      byteNumbers[i] = byteCharacters.charCodeAt(i);
    }

    const byteArray = new Uint8Array(byteNumbers);
    return new Blob([byteArray], { type: contentType });
  }
}