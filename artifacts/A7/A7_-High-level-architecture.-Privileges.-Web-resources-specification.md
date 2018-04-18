# A7: High-level architecture. Privileges. Web resources specification
 
## 1. Visão geral
 
Uma visão geral da aplicação web a implementar é apresentada nesta secção, onde os módulos irão ser identificados e brevemente descritos. Os recursos web associeados a cada um dos módulos são descritos em detalhe na documentação individual dos módulos.


| Modules   |      Description      |
|:----------|-------------:|
| M01: Autentificação e perfil individual |  Recursos web associados à autentificação do utilizador e a gestão do perfil individual. Inclui as seguintes funcionalidades: login/logout, registo, recuperação de password, ver e editar a informação do perfil e vincular e desvincular conta PayPal. |
| M02: Leilões |  Recursos web associados com os leilões. Inclui as seguintes funcionalidades: listagem de leilões, pesquisa, visualização, edição e licitação. |
| M03: Favoritos |  Recursos web associados com os favoritos. Inclui as seguintes funcionalidades: listagem de favoritos, adição e a sua remoção. |
| M04: Histórico |  Recursos web associados com o histórico. Incluí as seguintes funcionalidades: listagem de leilões onde o membro participou. | 
| M05: Notificações |   Recursos web associados às notificações. Inclui as seguintes funcionalidades: listagem de notificações e marcação noficações como lidas.  |
| M06: Mensagens |   Recursos web associados às mensagens. Inclui as seguintes funcionalidades: envio de mensagens e visualização de mensagens trocadas com outros membros  |
| M07: Meus leilões e leilões em que participo |  Recursos web associados com os leilões do próprio membro. Incluí as seguintes funcionalidades: leilões criados pelo próprio membro. |
| M08: Autentificação e área de gestão admin |  Recursos web associados à autentificação e gestão pelo utilizador. Incluí as seguintes funcionalidades: login/logout, suspender/reativar/banir utilizadores, promover/revogar direitos de moderador e aprovar solicitações de remoção de conta. | 
| M09: Moderação |  Recursos web associados à moderação. blabla. | 
| M10: Páginas estáticas |  Recursos web associados às páginas estáticas: about, faq, contact.  |



## 2. Permissões
 
Esta secção tem como objetivo definir as permissões usadas nos módulos para estabelecer as condições de acesso aos recursos da aplicação *web*.

|PUB|Público      | Grupo de utilizadores sem permissões|
|MMB|Membro       | Utilizadores autenticados           |
|VDD|Vendedor			|   |
|MDD|Moderador    | Grupo de utilizadores com permissões para moderar leliões e feedback trocado entre membros da aplicação|
|ADM|Administrador| Administrador da aplicação|
 
## 3. Módulos

Esta secção documenta todos os recursos web por módulo indicando o *URL*, o método *HTTP*, os seus possíveis parâmetros, interfaces com o utilizador (com referência ao artefacto A3) e a as suas possiveis respostas.

###  Módulo 01: Autentificação e perfil individual 

#### R101: Formulário de login

#### R102: Ação de login

#### R103: Ação de logout

#### R104: Formulário de registo

#### R105: Ação de registo

#### R106: Ver perfil

#### R107: Editar perfil




###  Módulo 02: Leilões 

### Módulo 03: Favoritos

### Módulo 04: Histórico 

### Módulo 05: Notificações

### Módulo 06: Mensagens 

### Módulo 07: Meus leilões

### 3.1 Module 1
 
### 3.2 Module 2
 
## 4. JSON/XML Types
 
> Document the JSON or XML responses that will be used by the web resources.
 
## Web resources descriptors <note important>Do not include on the final artefact</note>
 
  * URL - Resource identifier, following the RESTful resource naming conventions 
  * Description - Describe the resource, when it's used and why
  * UI - Reference to the A3 user interface used by the resource
  * SUBMIT - Reference to the actions/requests integrated with the resource
  * Method - HTTP request Method
  * Parameters - Information that is sent through the URL, by a query string or path
  * Request Body - Data associated and transmitted with each request
  * Returns - HTTP code returned from a request
  * Response Body - Data sent from the server, in response to a given request
  * Permissions - Required permissions to access the resource
 

***
 

GROUP1726, 11/4/2018

> Daniel Vieira Azevedo, up201000307@fe.up.pt

> Nelson André Garrido da Costa, up201403128@fe.up.pt

> Rúben José da Silva Torres, up201405612@fe.up.pt

> Tiago Lascasas dos Santos, up201503616@fe.up.pt