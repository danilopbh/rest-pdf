import { Action, createReducer, on } from '@ngrx/store';
import { loadDataSuccess, loadDataFailure } from './data.actions';
import { DataModel } from './data.model';

export interface State {
    data: DataModel | null; // Mensagem de erro em caso de sucesso
    error: string | null; //Mensagem de erro em caso de falha
}

export const initialState: State = {
    data: null,
    error: null,
};

export const dataReducer = createReducer(
    initialState,
    
    //Manipula o sucesso no carregamento dos dados
    on(loadDataSuccess, (state, { data }) => ({
        ...state,
        data, //Preenche o estado com os dados recebidos
        error: null //Limpa qualquer erro anterior, se existir
    })),

    //Manipula a falha no carregamento dos dados
    on(loadDataFailure, (state, { error }) => ({
        ...state,
        data: null, //Limpa os dados, pois a ação falhou
        error //Preenche o estado com a mensagem de erro
    }))
);

export function reducer(state: State | undefined, action: Action) {
    return dataReducer(state, action);
}