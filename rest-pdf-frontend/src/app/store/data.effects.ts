import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { DataService } from '../services/data.service';
import { loadData, loadDataSuccess, loadDataFailure } from './data.actions';
import { catchError, map, mergeMap } from 'rxjs/operators';
import { of } from 'rxjs';

@Injectable()
export class DataEffects {
    loadData$ = createEffect(() =>
        this.actions$.pipe(
            ofType(loadData),
            mergeMap(() =>
                this.dataService.getData().pipe(
                    map(data => loadDataSuccess({ data })), //Sucesso: retorna os dados
                    catchError(error => of(loadDataFailure({ error: error.message }))) //Falha: retorna o erro
                )
            )
        )
    );

    constructor(private actions$: Actions, private dataService: DataService) {}
}