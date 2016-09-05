# search-rdf-files
The application is used for do search in the file system and return the list with names and descriptions of files academic.

# __Equipe__
- Joerverson Santos
- Anderson Araújo

# __Como é a logica do sistema?__

o projeto funciona em 3 etapas basicas, onde são bem definidas:
 - __Upload do arquivo:__ o upload do do arquivo consiste em um fromulario onde será inserido algumas informações do arquivo como: nome, author, categoria, arquivo. e em seguida clica-se no `upload file`
 - __Criação do RDF:__ a geração do RDF é referente as informações fornecidas pelo formulario de upload onde será usado uma api chamada `Empire` converte jpa em RDF usando ORM com isos podemos gerar as tuplas para RDF sem muitos problemas nem dor de cabeça. o sistema irá criar o arquivo RDF caso no exista, se existir ele irá apenas adicionar novos recurso aquele arquivo RDF. lembrando que só haverá apenas um arquivo RDF contendo as informaoes dos arquivos que estão no servidor.
 - __Search files:__ no final de tudo isso temos a busca de arquivos, que será usando SPARQL, consultando o arquivo gerado e incrementado automaticamente com os uploads dos arquivos.

# __Campos do documento__
 - Titulo
 - Descrição
 - Palavras-chave
 - Autor
 - Responsável
 
## Protótipo
![img](https://lh5.googleusercontent.com/sRw4Fv0JJYGEZqZNjcJ-feFIvnf1-uKVlnVfrtyuN42om4BVVLnyxobpFpeIne0lMA0NZLmLZnQ2Lv8=w1366-h677-rw)

# __API usada__

 - [EasyRDF](http://www.easyrdf.org/) : API usada para poder manipular o RDF.

# __Ontologia reutilizada__

- [DCat](https://www.w3.org/TR/vocab-dcat/) : este vocabulario fou utilizado por ser completo em relação a documentos.
