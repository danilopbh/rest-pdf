import { createAction, props } from "@ngrx/store";
import { DataModel } from './data.model';

//Ação para carregar os dados (dispara o efeito)
export const loadData = createAction('[Data] Load Data');

//Ação de sucesso ao carregar os dados
export const loadDataSuccess = createAction(
    '[Data] Load Data Success',
    props<{data: DataModel}>() //Dados retornados com sucesso
);
//Ação de falha ao carregar os dados
export const loadDataFailure = createAction(
    '[Data] Load Data Failure',
    props<{error: string}>() //Mensagem de erro
);