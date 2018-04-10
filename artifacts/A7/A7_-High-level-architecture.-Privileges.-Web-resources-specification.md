# A7: High-level architecture. Privileges. Web resources specification

## 1. Visão geral

Uma visão geral da aplicação web a implementar é apresentada nesta secção, onde os módulos irão ser identificados e brevemente descritos. Os recursos web associeados a cada um dos módulos são descritos em detalhe na documentação individual dos módulos.

| Modules   |      Description      |
|:----------|:-------------|
| M01: Autentificação e perfil individual |  Recursos web associados à autentificação do utilizador e a gestão do perfil individual. Inclui as seguintes funcionalidades: login/logout, registo, recuperação de password, ver e editar a informação do perfil, pedir remoção de conta e vincular e desvincular conta PayPal. |
| M02: Leilões |  Recursos web associados com os leilões. Inclui as seguintes funcionalidades: listagem de leilões, pesquisa, visualização, edição e licitação. |
| M03: Listas do Utilizador autenticado |  Recursos web associados com os as listas de leilões associadas ao Utilizador autenticado. Inclui as seguintes funcionalidades: listagem de favoritos, adição e a sua remoção; listagem de leilões onde o membro participou; leilões criados pelo próprio membro, como vendedor; leilões onde o membro está a participar como comprador.|
| M04: Notificações |   Recursos web associados às notificações. Inclui as seguintes funcionalidades: listagem de notificações e marcação de notificações como lidas.  |
| M05: Comunicação entre membros |   Recursos web associados à comunicação entre membros. Inclui as seguintes funcionalidades: envio de mensagens e visualização de mensagens trocadas com outros membros, visualização, envio e remoção de *feedback*   |
| M06: Autentificação e área de gestão admin |  Recursos web associados à autentificação e gestão pelo utilizador. Incluí as seguintes funcionalidades: login/logout, suspender/reativar/banir utilizadores, promover/revogar direitos de moderador e aprovar solicitações de remoção de conta. |
| M07: Moderação |  Recursos web associados à moderação de leilões que aguardam aprovação. Incluí as seguintes funcionalidades: listagem de leilões que aguardam aprovação e respetiva aprovação. . |
| M8: Páginas estáticas |  Recursos web associados às páginas estáticas: About, FAQ, Contact.  |



## 2. Permissões

Esta secção tem como objetivo definir as permissões usadas nos módulos para estabelecer as condições de acesso aos recursos da aplicação *web*.

|Abreviatura|Tipo      | Permissões|
|:----------:|:-------------:|:-------------|
|MMB|Membro       | Utilizadores autenticados           |
|DON|Dono			| Grupo de utilizadores que podem alterar os seus perfis e têm privilégios relativos aos seus leilões |
|MDD|Moderador    | Grupo de utilizadores com permissões para moderar leliões e feedback trocado entre membros da aplicação|
|ADM|Administrador| Administrador da aplicação|

## 3. Módulos

Esta secção documenta todos os recursos web por módulo indicando o *URL*, o método *HTTP*, os seus possíveis parâmetros, interfaces com o utilizador (com referência ao artefacto A3) e a as suas possiveis respostas.

###  Módulo 01: Autentificação e Perfil Individual

Estes são os pontos de extremidade disponíveis no Módulo de Autenticação e Perfil Individual.

* R101: Ação de login /login
* R102: Ação de logout /logout
* R103: Ação de registo /register
* R104: Ver perfil /users/{id}
* R105: Ação de editar perfil /users/{id}
* R106: Ação de editar password users/{id}/password/edit


#### R101: Ação de login

<table>
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/login</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um utilizador realizar a ação de login. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Request body</td>
    <td >+username: String	</td>
    <td >Username do membro</td>
  </tr>
  <tr>
    <td > </td>
    <td >+password: String	</td>
    <td >Password do membro</td>
  </tr>
  <tr>
  <td > Redirecciona </td>
    <td > R201	</td>
    <td > Sucesso</td>
  </tr>  
    <tr>
  <td > </td>
    <td > R201	</td>
    <td > Erro</td>
  </tr> 
  <tr>
    <td colspan="2">Permissões</td>
    <td colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R102: Ação de logout

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/logout</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um utilizador, membro ou administrador, realizar a ação de logout. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td > Redirecciona </td>
    <td > <a href="#">R201</a></td>
    <td > Sucesso</td>
  </tr>
  <tr>
  <td > </td>
    <td > R201	</td>
    <td > Erro</td>
  </tr> 
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB, ADM </td>
  </tr>
  <tr>
</table>

#### R103: Ação de registo
<table>
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/register</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um visitante conseguir registar-se na aplicação. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Request body</td>
    <td >+name: String	</td>
    <td >Nome completo do visitante que se regista.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+username: String	</td>
    <td >username do visitante que se regista.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+age: Integer	</td>
    <td >Idade do visitante que se regista.</td>
  </tr>
  <tr>
   <tr>
  <td > </td>
    <td >+email: String	</td>
    <td >E-mail do visitante que se regista.</td>
  </tr>
  <tr>
  <td > </td>
    <td >+address: String	</td>
    <td >Morada do visitante que se regista.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+postalcode: Integer	</td>
    <td >Código postal do visitante que se regista.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+phonenumber: Integer	</td>
    <td >Número telefónico do visitante que se regista.</td>
  </tr>
  <tr>
  <td > </td>
    <td >+password: String	</td>
    <td >Password do visitante que se regista</td>
  </tr>
 <tr>
  <td > </td>
    <td >+confirmPassword: String	</td>
    <td >Password de confirmação do visitante que se regista</td>
  </tr>
  <tr>
  <td > Redirecciona </td>
    <td > <a href="#">R201</a> 	</td>
    <td > Sucesso</td>
  </tr> 
   <tr>
  <td > </td>
    <td > R201	</td>
    <td > Erro</td>
  </tr>   
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> PUB </td>
  </tr>
</table>

#### R104: Ver perfil
<table>
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado por um Membro para aceder a uma página de perfil. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
  </tr>
  <tr>
  <td > Parâmetros </td>
    <td > +id: Integer</td>
    <td > Chave primária de um membro</td>
  </tr>
 <tr>
    <td colspan="2"> IU </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
</tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB</td>
  </tr>
  <tr>
</table>

#### R105: Ação de editar perfil
<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/edit</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um Membro submeter as edições na informação do seu perfil. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Request body</td>
    <td >+name: String	</td>
    <td >Nome completo do Membro.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+age: Integer	</td>
    <td >Idade do Membro.</td>
  </tr>
  <tr>
   <tr>
  <td > </td>
    <td >+email: String	</td>
    <td >E-mail do Membro.</td>
  </tr>
  <tr>
  <td > </td>
    <td >+address: String	</td>
    <td >Morada do Membro.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+postalcode: Integer	</td>
    <td >Código postal do Membro.</td>
  </tr>
 <tr>
  <td > </td>
    <td >+phonenumber: Integer	</td>
    <td >Número telefónico do Membro.</td>
  </tr>
  <tr>
  <td > </td>
    <td >+country: String	</td>
    <td >País do Membro.</td>
 </tr> 
   <tr>
  <td > Redirecciona </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
    <td > Sucesso</td>
  </tr>  
  <tr>
  <td > </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
    <td > Erro</td>
  </tr> 
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> DON </td>
  </tr>
  <tr>
</table>

#### R106: Ação de editar password
<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/password/reset</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um Membro submeter as edições na sua password. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Corpo do Pedido</td>
    <td >+oldPassword: String	</td>
    <td >Password atual do Membro.</td>
  </tr>
   <tr>
  <td > </td>
    <td >+newPassword: String	</td>
    <td >Nova password do Membro.</td>
  </tr>
  <tr>
  <td > </td>
    <td >+confirmNewPassword: String	</td>
    <td >Confirmação da nova password do Membro.</td>
  </tr>
  <tr>
  <td > Redirecciona </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
    <td > Sucesso</td>
  </tr>  
  <tr>
  <td > </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
    <td > Erro</td>
  </tr>  
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> DON </td>
  </tr>
  <tr>
</table>


###  Módulo 02: Leilões

Estes são os pontos de extremidade disponíveis no Módulo de Leilões:

* R201: Ver página inicial com leilões /home
* R202: Formulário de pesquisa de leilões /search
* R203: API de pesquisa de leilões /api/search
* R204: Ver um leilão /auction/{id}
* R205: Formulário de criação de um leilão /createAuction
* R206: Ação de criação de um leilão /createAuction
* R207: Formulário de edição de um leilão /editAuction/{id}
* R208: Ação de edição de um leilão /editAuction/{id}
* R209: Ação de licitar num leilão /auction/{id}/bid
* R210: Ação de atualizar o valor da licitação atual /auction/{id}/bid

#### R201: Ver página inicial com leilões

|URL |	/home|
|:---|:----|
|Descrição |	Obter a página inicial. |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/home.html) |
|Corpo da resposta|JSON201
| Permissões  |	PUB |

#### R202: Página de pesquisa de leilões

|URL |	/search|
|:---|:----|
|Descrição |	Pesquisa avançada de leilões. |
|Método |	GET |
|Parâmetros|?keywords: string | Palavras-chave da pesquisa
||?title: string | Título
||?publisher: string | Editora
||?author: string | Autor
||?isbn: string | ISBN
||?lang: string | Idioma
||?category: string | Categoria
||?maxBid: number | Valor máximo da licitação atual
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/search.html) |
|Chamadas AJAX|JSON201
| Permissões  |	PUB |

#### R203: API de pesquisa de leilões

|URL |	/api/search|
|:---|:----|
|Descrição |	Submete uma pesquisa de leilões, retornando a mesma página com os resultados |
|Método |	GET |
|Parâmetros|?keywords: string | Palavras-chave da pesquisa
||?title: string | Título
||?publisher: string | Editora
||?author: string | Autor
||?isbn: string | ISBN
||?lang: string | Idioma
||?category: string | Categoria
||?maxBid: number | Valor máximo da licitação atual
|Corpo da resposta|JSON201
| Permissões  |	PUB |

#### R204: Ver um leilão /auction/{id}

|URL |	/auction/{id}|
|:---|:----|
|Descrição |	Ver um leilão |
|Método |	GET |
|Parâmetros|id: number| ID do leilão a visualizar
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/auction.html) |
|Corpo da resposta|JSON204
|Retornos|200 OK| O pedido foi realizado com sucesso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão com o id especificado não exista
| Permissões  |	MMB |

#### R205: Formulário de criação de um leilão

|URL |	/create|
|:---|:----|
|Descrição |	Formulário para a criação de um novo leilão |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/create.html) |
|SUBMIT|R206
| Permissões  |	MMB |

#### R206: Ação de criação de um leilão

|URL |	/create|
|:---|:----|
|Descrição |	Cria um novo leilão |
|Método |	POST |
|Corpo do pedido|?title: string | Título
||?publisher: string | Editora
||?author: string | Autor
||?isbn: string | ISBN
||?lang: string | Idioma
||?category: string | Categoria
||?desc: string | Descrição do item
||?img: string | Imagens
|Redirecciona|R204
| Permissões  |	MMB |

#### R207: Formulário de edição de um leilão

|URL |	/editAuction/{id}|
|:---|:----|
|Descrição |	Formulário para a edição de um leilão existente |
|Método |	GET |
|Parâmetros|id: number| ID do leilão a editar
| IU | IUXX (sem mockup elaborada)|
|SUBMIT|R208
| Permissões  |	DON |

#### R208: Ação de pedido de edição de um leilão

|URL |	/editAuction/{id}|
|:---|:----|
|Descrição |	Envia um pedido de edição de um leilão existente |
|Método |	POST |
|Corpo do pedido|id: number| ID do leilão a editar
||?desc: string | Descrição do item
||?img: string | Novas imagens
|Retornos|200 OK| O pedido de edição foi realizado com suceso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão com o id especificado não exista
|Redirecciona|R204
| Permissões  |	VDD |

#### R209: Ação de licitar num leilão

|URL |	/auction/{id}/bid|
|:---|:----|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	POST |
|Corpo do pedido|?id: number | ID do leilão
||?userID: number | ID do utilizador autenticado
||?value: number | Nova licitação
|Redirecciona|R204
| Permissões  |	MMB |

#### R210: API para obter o valor da licitação atual

|URL |	/api/bid/{id}|
|:---|:----|
|Descrição |	Requisita o valor atual da licitação do leilão especificado |
|Método |	GET |
|Parâmetros|?id: number | ID do leilão
|Corpo da resposta|JSON202
| Permissões  |	PUB |


### Módulo 03: Listas do utilizador autenticado

Estes são os pontos de extremidade disponíveis no Módulo das Listas do Utilizador Autenticado:

* R301: Ver a wishlist /wishlist
* R302: Ação de adição de um leilão à wishlist /wishlist/{id}
* R303: Ação de remoção de um leilão da wishlist /wishlist/{id}
* R304: Ver o histórico de leilões /history
* R305: Ver a lista dos leilões criados /myAuctions
* R306: Ver a lista dos leilões em que se está a participar /currentAuctions

#### R301: Ver a __wishlist__

|URL |	/wishlist|
|:---|:----|
|Descrição |	Ver a wishlist do utilizador autenticado |
|Método |	GET |
| IU |	[IU13](https://tiagolascasas.github.io/lbaw1726/wishlist.html) |
|Corpo da resposta|JSON201
| Permissões  |	MMB |

#### R302: Ação de adição de um leilão à __wishlist__

|URL |	/wishlist/{id}|
|:---|:----|
|Descrição |	Adiciona um leilão à wishlist do utilizador |
|Método |	POST |
|Corpo do pedido|?id: number | ID do leilão
||?userID: number | ID do utilizador autenticado
|Retornos|200 OK| O pedido de adição foi realizado com sucesso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão ou utilizador com o id especificado não exista
| Permissões  |	MMB |

#### R303: Ação de remoção de um leilão da __wishlist__

|URL |	/wishlist/{id}|
|:---|:----|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	DELETE |
|Parâmetros|?id: number | ID do leilão
||?userID: number | ID do utilizador autenticado
|Retornos|200 OK| O pedido de remoção foi realizado com sucesso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão ou utilizador com o id especificado não exista
| Permissões  |	MMB |

#### R304: Ver o histórico de leilões

|URL |	/history|
|:---|:----|
|Descrição |	Ver o histórico de leilões completados do utilizador autenticado |
|Método |	GET |
|Corpo da resposta|JSON201
| IU |	[IU12](https://tiagolascasas.github.io/lbaw1726/history.html) |
| Permissões  |	MMB |

#### R305: Ver a lista dos leilões criados

|URL |	/myAuctions|
|:---|:----|
|Descrição |	Ver a lista dos leilões criados pelo utilizador autenticado |
|Método |	GET |
| IU |	[IU10](https://tiagolascasas.github.io/lbaw1726/myAuctions.html) |
|Corpo da resposta|JSON201
| Permissões  |	MMB |

#### R306: Ver a lista dos leilões em que se está a participar

|URL |	/currentAuctions|
|:---|:----|
|Descrição |	Ver a lista dos leilões ativos em que o utilizador autenticado está a participar |
|Método |	GET |
| IU |	[IU11](https://tiagolascasas.github.io/lbaw1726/auctionsIm_in.html) |
|Corpo da resposta|JSON201
| Permissões  |	MMB |

### Módulo 04: Notificações

Estes são os pontos de extremidade disponíveis no Módulo de Notificações:
* R401: Acção listagem de notificações não lidas.
* R402: Acção marcar notificação como lida.

#### R401: Acção listagem de notificações não lidas
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/notifications</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Recurso que busca todas as notificações não lidas de um utilizador</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
   </tr>
   <tr>
    <td colspan="2">Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária de um membro</td>
   </tr>
   <tr>
    <td >Corpo da resposta</td>
    <td colspan="2">JSON501</td>
   </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>


#### R402: Acção marcar notificação como lida.
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/notifications</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Recurso usado para marcar uma notificação como lida</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
   </tr>
   <tr>
    <td >Corpo do pedido</td>
    <td >+id_member: Integer	</td>
    <td >Chave primária do membro</td>
   </tr>
   <tr>
    <td></td>
    <td >+id_notification: Integer	</td>
    <td >Chave primária da notificação</td>
   </tr>
   <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A notificação foi marcada como lida com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Notificação com a chave primária especificada não encontrada.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
  </tr>
</table>

### Módulo 05: Comunicação entre membros

Estes são os pontos de extremidade disponíveis no Módulo de Comunicação entre membros.
* R501: Ver Mensagens /messages
* R502: Formulário para criar Mensagem /messages/new_message
* R503: Acção para criar Mensagem /messages
* R504: Ação para listar comentários /users/{id}/comments 
* R505: Acção para criar comentário /users/{id}/comments
* R506: Ação de reprovar comentário /users/{id}/comments/remove

#### R501: Ver Mensagens
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Obter todas as mensagens relacionadas com o membro em questão</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
   </tr>
   <tr>
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária de um membro</td>
   </tr>
   <tr>
    <td  colspan="2">Corpo da resposta</td>
    <td >JSON601</td>
   </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>


#### R502:  Formulário criar Mensagem .
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages/new_message</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Página com um form para enviar uma mensagem</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
   </tr>
   <tr>
    <td colspan="2">Submit </td>
    <td >R603</td>
   </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
  </tr>
</table>

#### R503: Acção para criar Mensagem /messages .
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Cria uma nova mensagem. Redireciona para a nova página de mensagens em caso de sucesso ou para um novo formulário de nova mensagem em caso de insucesso</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
   </tr>
   <tr>
    <td >Corpo do pedido</td>
    <td >+message_text: text	</td>
    <td >Corpo da mensagem</td>
  </tr>
  <tr>
    <td ></td>
    <td >+idSender: Integer	</td>
    <td >Chave primária do membro que enviou a mensagem</td>
  </tr>
 <tr>
    <td ></td>
    <td >+idReceiver: Integer	</td>
    <td >Chave primária do membro a quem foi enviada a mensagem</td>
   </tr>
    <tr>
  <td > Redirecciona </td>
    <td >R501	</td>
    <td > Sucesso</td>
  </tr>  
    <tr>
  <td >  </td>
     <td > R502	</td>
    <td > Insucesso </td>
  </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>

#### R504: Ação para listar comentários 
<table>
   <tr>
    <td  colspan="2">URL</td>
    <td colspan="2">/users/{id}/comments</td>
   </tr>
   <tr>
    <td colspan="2">Descrição</td>
    <td colspan="2">Obter todas os comentários recebidos pelo membro em questão</td>
   </tr>
   <tr>
    <td colspan="2">Método</td>
    <td colspan="2">GET</td>
   </tr>
   <tr>
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária do membro</td>
   </tr>
   <tr>
    <td colspan="2">Corpo da resposta</td>
    <td >JSON604</td>
   </tr>
   <tr>
    <td colspan="2">Permissões</td>
    <td colspan="2"> MMB </td>
   </tr>
</table>

#### R505: Acção para criar comentário.
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/comments</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Cria uma novo comentário no perfil do membro em questão.</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
   </tr>
   <tr>
    <td >Corpo do pedido</td>
    <td >+liked: boolean	</td>
    <td >Comentário positivo ou negativo</td>
  </tr>
   <tr>
    <td ></td>
    <td >+comment_text: text	</td>
    <td >Corpo do comentário</td>
  </tr>
   <tr>
    <td ></td>
    <td >+idSender: Integer	</td>
    <td >Chave primária do membro que enviou o comentário</td>
  </tr>
   <tr>
    <td ></td>
    <td >+idReceiver: Integer	</td>
    <td >Chave primária do membro a quem o comentário foi dado</td>
   </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >Comentário enviado com sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>

#### R506: Ação de reprovar comentário

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/comments/remove</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que reprova um comentário de feedback especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do comentário</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O comentário de feedback foi removido com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Comentário de feedback com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>

### Módulo 06: Autentificação e área de gestão admin

Estes são os pontos de extremidade disponíveis no Módulo de Autenticação e área de gestão admin:
* R601: Formulário de login admin /adminLogin
* R602: Ação de login admin /adminLogin
* R603: Ver painel do admin /admin
* R604: Aceitar pedido de remoção de conta /admin/terminate
* R605: Ignorar pedido de remoção de conta /admin/ignore
* R606: Ação suspensão /admin/suspend
* R607: Ação de reativar suspensão /admin/reactivate
* R608: Ação de banir permanentemente /admin/ban
* R609: Ação de promover a moderador /admin/promote_moderator
* R610: Ação de revocar privilegios de moderador /admin/remoke_moderator

#### R601: Formulário de login admin

|URL |	/adminLogin|
|:---:|:----:|
|Descrição |	Página com formulário para login do Administrador. |
|Método |	GET |
| IU |	[IU016](https://tiagolascasas.github.io/lbaw1726/adminLogin.html) |
| SUBMIT |	<a href="#r602-ação-de-login-admin">R602</a>	 |
| Permissões  |	PUB |

#### R602: Ação de login admin

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/adminLogin</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que envia uma mensagem definida pelo utilizador para o e-mail definido pelo admin. Redirecciona para a mesma página em qualquer caso e mostra uma notificação de acordo com o sucesso ou insucesso ao enviar a mensagem. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Corpo do pedido</td>
    <td >+username: string	</td>
    <td >Username do admin</td>
  </tr>
  <tr>
  <td > </td>
    <td >+password: string	</td>
    <td >Password do admin</td>
  </tr>
  <tr>
  <td > Redirecciona </td>
    <td > <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td > Sucesso</td>
  </tr>  
    <tr>
  <td >  </td>
     <td > <a href="#r601-formulário-de-login-admin">R601</a>	</td>
    <td > Insucesso </td>
  </tr>  
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R603: Ver painel do admin

|URL |	/admin|
|:---:|:----:|
|Descrição |	Obter pedidos de remoção de conta. |
|Método |	GET |
| IU |	[IU015](https://tiagolascasas.github.io/lbaw1726/admin.html) |
|Corpo da resposta|JSON603|
| Permissões  |	ADM |

#### R604: Aceitar pedido de remoção de conta

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/terminate</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que aceita o pedido de remoção de conta do membro especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>  
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro foi removida com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R605: Ignorar pedido de remoção de conta

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/ignore</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que ignora o pedido de remoção de conta do membro especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>  
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O pedido de remoção da conta do membro foi ignorado com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R606: Ação suspensão

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/suspend</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que suspende a conta do membro especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>  
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro foi suspensa com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R607: Ação de reativar suspensão

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/reactivate</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que reativa a conta de um membro especificado com conta suspensa. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro suspensa foi reativada com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado..</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R608: Ação de banir permanentemente

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/ban</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que bane a conta do membro especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro foi banida com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R609: Ação de promover a moderador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/promote_moderator</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que promove a moderador a conta do membro especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro foi promovida a moderador com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Membro com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

#### R610: Ação de revocar privilegios de moderador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/admin/revoke_moderator</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que revoca de moderador uma conta do membro especificado anteriormente promovida a moderador. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do membro</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >A conta do membro foi despromovida de moderador com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >A mensagem foi enviada com sucesso.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> ADM </td>
  </tr>
</table>

### Módulo 07: Moderação de leilões

Estes são os pontos de extremidade disponíveis no Módulo de Moderação de leilões:
* R701: Ver anúncios que aguardam aprovação /moderator
* R702: Ação de aprovar anúncio /moderator/approve_auction
* R703: Ação de reprovar anúncio /moderator/remove_auction

#### R701: Ver anúncios que aguardam aprovação

|URL |	/moderator|
|:---|:----|
|Descrição |	Obter pedidos de aprovação do anúncio. |
|Método |	GET |
| IU |	[IU014](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu014-painel-do-moderador) |
|Corpo da resposta|JSON701|
| Permissões  |	MDD |

#### R702: Ação de aprovar anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/moderator/approve_auction</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que aprova um leilão especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do leilão</td>
  </tr> 
  <tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O leilão foi aprovado com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Leilão com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>

#### R703: Ação de reprovar anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/moderator/remove_auction</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que reprova um leilão especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do leilão</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O leilão foi reprovado com sucesso.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Leilão com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>



### Módulo 08: Páginas estáticas

Estes são os pontos de extremidade disponíveis no Módulo de Páginas Estáticas:
* R801: Página Sobre /about
* R802: Questões Frequentes /faq
* R803: Contactos /contact
* R804: Enviar mensagem de contacto /contact

#### R801 Página Sobre

|URL |	/about|
|:---:|:----:|
|Descrição |	Obter página sobre. |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/about.html) |
| Permissões  |	PUB |

#### R802: Questões Frequentes

|URL |	/faq|
|:---:|:----:|
|Descrição |	Obter página Questões Frequentes. |
|Método |	GET |
| IU |	[IU07](https://tiagolascasas.github.io/lbaw1726/faq.html) |
| Permissões  |	PUB |

#### R803: Contactos

|URL |	/contact|
|:---:|:----:|
|Descrição |	Obter página Contactos. |
|Método |	GET |
| IU |	[IU06](https://tiagolascasas.github.io/lbaw1726/contact.html) |
| Permissões  |	PUB |

#### R804: Enviar mensagem de contacto

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/contact</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que envia uma mensagem definida pelo utilizador para o e-mail definido pelo admin. Redirecciona para a mesma página em qualquer caso e mostra uma notificação de acordo com o sucesso ou insucesso ao enviar a mensagem. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <tr>
  <td >Corpo do pedido</td>
    <td >+name: string	</td>
    <td >Nome do utilizador</td>
  </tr>
  <tr>
  <td > </td>
    <td >+email: string	</td>
    <td >E-mail do utilizador</td>
  </tr>
  <tr>
  <td > </td>
    <td >+message: string	</td>
    <td >Mensagem do utilizador </td>
  </tr>  
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >Mensagem enviada com sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> PUB </td>
  </tr>
  <tr>
</table>


## 4. JSON/XML Types

JSON201: lista simplificada de leilões

```
{
    "auctions": [
        {
            "id": "1",
            "imageSrc": "book1.jpg",
            "secondsLeft": "19234",
            "currentMaxBid": "7.14",
            "sellerId": "24",
            "sellerName": "IAmASeller",
            "isWishlisted": "true",
            "title": "The Orphan's Tale",
            "author": "Pam Jennof"
        },
        {
            "id": "2",
            "imageSrc": "book2.jpg",
            "secondsLeft": "67901241",
            "currentMaxBid": "89.87",
            "sellerId": "567",
            "sellerName": "AnotherSeller",
            "isWishlisted": "false",
            "title": "Born a crime",
            "author": "Trevor Noah"
        }
    ]
}
```

JSON202: valor atual da licitação de um leilão

JSON501: Ver notificações: {notificação}[]
```
{
  "notification: [
    {
      "id": "5",
      "dateSent": "2001-12-23 14:39:53.662522-05",
      "information": "Someone covered your offer",
      "is_seen": "false",
      "dateSeen": "NULL",
      "idMember": "2"
    },
    {
      "id": "10",
      "dateSent": "2001-12-31 09:50:53.662522-05",
      "information": "Your Auction has ended",
      "is_seen": "false",
      "dateSeen": "NULL",
      "idMember": "2"
    }
  ]
}
```

GROUP1726, 11/4/2018

> Daniel Vieira Azevedo, up201000307@fe.up.pt

> Nelson André Garrido da Costa, up201403128@fe.up.pt

> Rúben José da Silva Torres, up201405612@fe.up.pt

> Tiago Lascasas dos Santos, up201503616@fe.up.pt
