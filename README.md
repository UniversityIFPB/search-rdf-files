# search-rdf-files
The application is used for do search in the file system and return the list with names and descriptions of files academic.

# __Team__
- Joerverson Santos
- Anderson Araújo

# __How working the logic?__

o projeto funciona em 3 etapas basicas, onde são bem definidas:
 - __Upload do arquivo:__ o upload do do arquivo consiste em um fromulario onde será inserido algumas informações do arquivo como: nome, author, categoria, arquivo. e em seguida clica-se no `upload file`
 - __Criação do RDF:__ a geração do RDF é referente as informações fornecidas pelo formulario de upload onde será usado uma api chamada `Empire` converte jpa em RDF usando ORM com isos podemos gerar as tuplas para RDF sem muitos problemas nem dor de cabeça. o sistema irá criar o arquivo RDF caso no exista, se existir ele irá apenas adicionar novos recurso aquele arquivo RDF. lembrando que só haverá apenas um arquivo RDF contendo as informaoes dos arquivos que estão no servidor.
 - __Search files:__ no final de tudo isso temos a busca de arquivos, que será usando SPARQL, consultando o arquivo gerado e incrementado automaticamente com os uploads dos arquivos.

# __API used__

 - [sparql-code-examples](https://github.com/ncbo/sparql-code-examples) : contem não só apenas java, mas varias linguagens para fazer consultas SPARQL.
 - [Empire](https://github.com/mhgrove/Empire) : API usada para converter JPA em RDF usando ORM de uma foma simples.

# __Vocabulary used__

- [Scheme](http://lov.okfn.org/dataset/lov/vocabs/schema) : este vocabulario vai ser usado no sistema por ser proprio paar mecanismo de busca, onde o google, bing, yahoo.. o utiliza nas suas engimes.
