import { Component } from "@angular/core";
import { DataService } from "../services/data.service";

@Component({
    selector: 'app-data-actions',
    templateUrl: './data-actions.component.html',
    styleUrls: ['./data-actions.component.scss']
})

export class DataActionsComponent{
    constructor(private dataService: DataService) {}
    
    loadFixtures() {
    this.dataService.loadFixtures().subscribe(response => {
        console.log(response);
        alert('Tabelas do Siatu realimentadas com sucesso.');
    });
}

    copyData(){
        this.dataService.copyData().subscribe(response => {
            console.log(response);
            alert('Dados sincronizados com sucesso.');
        });
    }
}