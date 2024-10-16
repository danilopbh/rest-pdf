//Definição do modelo para as tabelas cda_siatu e cda_supp
export interface Cda{
    id: number;
    descricao: string;
    dataVencimento: string; //Data em formato ISO
    valor: number;
    pdfDivida: string; //Poder ser um base64 do PDF ou outro tipo
}

//Definição do modelo para as tabelas contribuinte_siatu e contribuinte_supp
export interface Contribuinte{
    id: number;
    nome: string;
    cpf: string;
    endereco: string;
}

//Modelo que representa a estrutura completa de dados retornados pela API
export interface DataModel{
    cda_siatu: Cda[]; //Array de objetos do tipo Cda
    contribuinte_siatu: Contribuinte[]; //Array de objetos do tipo Contribuinte
    cda_supp: Cda[]; //Array de objetos do tipo Cda (tabela cda_supp)
    contribuinte_supp: Contribuinte[]; //Array de objetos do tipo Contribuinte (tabela contribuinte_supp)
}