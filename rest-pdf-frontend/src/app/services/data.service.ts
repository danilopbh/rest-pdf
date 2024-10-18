import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { DataModel } from '../store/data.model'; // O modelo dos dados da API

@Injectable({
    providedIn: 'root',
})
export class DataService {
    private apiUrl = '/api/data'; // URL da API Symfony

    constructor(private http: HttpClient) {}

    // Retorna os dados tipados de acordo com o modelo DataModel
    getData(): Observable<DataModel> {
        return this.http.get<DataModel>(this.apiUrl); // Requisição para a API do Symfony
    }

    //Chama o endpoint para carregar as fixtures
    loadFixtures(): Observable<any>{
        return this.http.post(`${this.apiUrl}/load-fixtures`, {});
    }

    //Chama o endpoint para copiar os dados
    copyData(): Observable<any> {
        return this.http.post(`${this.apiUrl}/sync-data`, {});
    }
}