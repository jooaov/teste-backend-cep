# Projeto Backend de CEP

Este projeto é um serviço de backend que fornece informações sobre endereços com base em CEPs fornecidos. Ele utiliza Laravel para fornecer uma API que consulta informações de CEPs.

## Endpoint

### `/search/local/{cep}`

Este endpoint permite buscar informações de localização com base em um ou mais CEPs. Os CEPs devem ser fornecidos separados por vírgula. 

#### Exemplo de Requisição

- **URL:** `http://127.0.0.1:8000/search/local/01001000,17560-246`
- **Método:** `GET`

#### Exemplo de Resposta

A resposta será um JSON contendo informações sobre os endereços dos CEPs fornecidos. Aqui está um exemplo de resposta:

```json
[
    {
        "cep": "17560246",
        "label": "Avenida Paulista, Vera Cruz",
        "logradouro": "Avenida Paulista",
        "complemento": "de 1600/1601 a 1698/1699",
        "bairro": "CECAP",
        "localidade": "Vera Cruz",
        "uf": "SP",
        "ibge": "3556602",
        "gia": "7134",
        "ddd": "14",
        "siafi": "7235"
    },
    {
        "cep": "01001000",
        "label": "Praça da Sé, São Paulo",
        "logradouro": "Praça da Sé",
        "complemento": "lado ímpar",
        "bairro": "Sé",
        "localidade": "São Paulo",
        "uf": "SP",
        "ibge": "3550308",
        "gia": "1004",
        "ddd": "11",
        "siafi": "7107"
    }
]
