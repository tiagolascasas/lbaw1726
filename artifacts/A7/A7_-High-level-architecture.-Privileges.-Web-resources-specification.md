# A7: High-level architecture. Privileges. Web resources specification

## 1. Visão geral

Uma visão geral da aplicação web a implementar é apresentada nesta secção, onde os módulos irão ser identificados e brevemente descritos. Os recursos web associeados a cada um dos módulos são descritos em detalhe na documentação individual dos módulos.

| Modules   |      Description      |
|:----------|-------------:|
| M01: Autentificação e perfil individual |  Recursos web associados à autentificação do utilizador e a gestão do perfil individual. Inclui as seguintes funcionalidades: login/logout, registo, recuperação de password, ver e editar a informação do perfil, pedir remoção de conta e vincular e desvincular conta PayPal. |
| M02: Leilões |  Recursos web associados com os leilões. Inclui as seguintes funcionalidades: listagem de leilões, pesquisa, visualização, edição e licitação. |
| M03: Favoritos |  Recursos web associados com os favoritos. Inclui as seguintes funcionalidades: listagem de favoritos, adição e a sua remoção. |
| M04: Histórico |  Recursos web associados com o histórico. Incluí as seguintes funcionalidades: listagem de leilões onde o membro participou. |
| M05: Notificações |   Recursos web associados às notificações. Inclui as seguintes funcionalidades: listagem de notificações e marcação noficações como lidas.  |
| M06: Mensagens |   Recursos web associados às mensagens. Inclui as seguintes funcionalidades: envio de mensagens e visualização de mensagens trocadas com outros membros  |
| M07: Meus leilões e leilões em que participo |  Recursos web associados com os leilões do próprio membro. Incluí as seguintes funcionalidades: leilões criados pelo próprio membro. |
| M08: Autentificação e área de gestão admin |  Recursos web associados à autentificação e gestão pelo utilizador. Incluí as seguintes funcionalidades: login/logout, suspender/reativar/banir utilizadores, promover/revogar direitos de moderador e aprovar solicitações de remoção de conta. |
| M09: Moderação |  Recursos web associados à moderação de leilões que aguardam aprovação. Incluí as seguintes funcionalidades: listagem de leilões que aguardam aprovação e respetiva aprovação. |
| M10: Páginas estáticas |  Recursos web associados às páginas estáticas: About, FAQ, Contact.  |



## 2. Permissões

Esta secção tem como objetivo definir as permissões usadas nos módulos para estabelecer as condições de acesso aos recursos da aplicação *web*.

|PUB|Público      | Grupo de utilizadores sem permissões|
|:----------:|:-------------:|-------------:|
|MMB|Membro       | Utilizadores autenticados           |
|VDD|Vendedor			| Membro com leilão ativo  |
|MDD|Moderador    | Grupo de utilizadores com permissões para moderar leliões e feedback trocado entre membros da aplicação|
|ADM|Administrador| Administrador da aplicação|

## 3. Módulos

Esta secção documenta todos os recursos web por módulo indicando o *URL*, o método *HTTP*, os seus possíveis parâmetros, interfaces com o utilizador (com referência ao artefacto A3) e a as suas possiveis respostas.

###  Módulo 01: Autentificação e Perfil Individual

#### Pontos de extremidade do Módulo de Autentifcação e do Perfil Individual

Estes são os pontos de extremidade disponíveis no Módulo de Autenticação e Perfil Individual.

* R101: Formulário de login /login
* R102: Ação de login /login
* R103: Ação de logout /logout
* R104: Formulário de registo /register
* R105: Ação de registo /register
* R106: Ver perfil /users/{id}
* R107: Formulário de editar perfil /users/{id}/edit
* R108: Ação de editar perfil /users/{id}
* R109: Formulário de criação de comentário /users/{id}/comment
* R110: Ação de criação de comentário /users/{id}/comment

#### R101: Formulário de login

<table>
    <tr>
        <td><strong>URL</strong></td> <td></td>
    </tr>
    <tr>
        <td><strong>Descrição</strong></td> <td></td>
    </tr>
    <tr>
        <td><strong>Método</strong></td> <td></td>
    </tr>
    <tr>
        <td><strong>UI</strong></td> <td></td>
    </tr>
    <tr>
        <td><strong>SUBMIT</strong></td> <td></td>
    </tr>
    <tr>
        <td><strong>Permissões</strong></td> <td></td>
    </tr>
</table>

#### R102: Ação de login

#### R103: Ação de logout

#### R104: Formulário de registo

#### R105: Ação de registo

#### R106: Ver perfil

#### R107: Formulário de editar perfil

#### R107: Ação de editar perfil


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
|:---:|:----:|
|Descrição |	Obter a página inicial. |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/home.html) |
|AJAX Calls|R210
| Permissões  |	PUB |

#### R202: Página de pesquisa de leilões

|URL |	/search|
|:---:|:----:|
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
|Chamadas AJAX|R203
| Permissões  |	PUB |

#### R203: API de pesquisa de leilões

|URL |	/api/search|
|:---:|:----:|
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
|:---:|:----:|
|Descrição |	Ver um leilão |
|Método |	GET |
|Parâmetros|id: number| ID do leilão a visualizar
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/auction.html) |
|AJAX Calls|R210
|Retornos|200 OK| O pedido foi realizado com sucesso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão com o id especificado não exista
| Permissões  |	MMB |

#### R205: Formulário de criação de um leilão

|URL |	/create|
|:---:|:----:|
|Descrição |	Formulário para a criação de um novo leilão |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/create.html) |
|SUBMIT|R206
| Permissões  |	MMB |

#### R206: Ação de criação de um leilão

|URL |	/create|
|:---:|:----:|
|Descrição |	Cria um novo leilão |
|Método |	POST |
|Parâmetros|?title: string | Título
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
|:---:|:----:|
|Descrição |	Formulário para a edição de um leilão existente |
|Método |	GET |
|Parâmetros|id: number| ID do leilão a editar
| IU | IUXX (sem mockup elaborada)|
|SUBMIT|R208
| Permissões  |	VDD |

#### R208: Ação de pedido de edição de um leilão

|URL |	/editAuction/{id}|
|:---:|:----:|
|Descrição |	Envia um pedido de edição de um leilão existente |
|Método |	POST |
|Parâmetros|id: number| ID do leilão a editar
||?desc: string | Descrição do item
||?img: string | Novas imagens
|Retornos|200 OK| O pedido de edição foi realizado com suceso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão com o id especificado não exista
|Redirecciona|R204
| Permissões  |	VDD |

#### R209: Ação de licitar num leilão

|URL |	/auction/{id}/bid|
|:---:|:----:|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	POST |
|Parâmetros|?id: number | ID do leilão
||?userID: number | ID do utilizador autenticado
||?value: number | Nova licitação
|Redirecciona|R204
| Permissões  |	MMB |

#### R210: API para obter o valor da licitação atual

|URL |	/api/bid/{id}|
|:---:|:----:|
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
|:---:|:----:|
|Descrição |	Ver a wishlist do utilizador autenticado |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/wishlist.html) |
|AJAX Calls|R210
| Permissões  |	MMB |

#### R302: Ação de adição de um leilão à __wishlist__

|URL |	/wishlist/{id}|
|:---:|:----:|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	POST |
|Parâmetros|?id: number | ID do leilão
||?userID: number | ID do utilizador autenticado
|Retornos|200 OK| O pedido de adição foi realizado com sucesso
||400 Bad Request| Erro cuja causa está identificada no __header__ HTTP
||404 Not Found| Erro caso o leilão ou utilizador com o id especificado não exista
| Permissões  |	MMB |

#### R303: Ação de remoção de um leilão da __wishlist__

|URL |	/wishlist/{id}|
|:---:|:----:|
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
|:---:|:----:|
|Descrição |	Ver o histórico de leilões completados do utilizador autenticado |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/history.html) |
| Permissões  |	MMB |

#### R305: Ver a lista dos leilões criados

|URL |	/myAuctions|
|:---:|:----:|
|Descrição |	Ver a lista dos leilões criados pelo utilizador autenticado |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/myAuctions.html) |
|AJAX Calls|R210
| Permissões  |	MMB |

#### R306: Ver a lista dos leilões em que se está a participar

|URL |	/currentAuctions|
|:---:|:----:|
|Descrição |	Ver a lista dos leilões ativos em que o utilizador autenticado está a participar |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/auctionsIm_in.html) |
|AJAX Calls|R210
| Permissões  |	MMB |


### Módulo 05: Notificações

### Módulo 06: Mensagens

### Módulo 08: Autentificação e área de gestão admin
* R801: Formulário de login admin /adminLogin
* R802: Ação de login admin /adminLogin
* R803: Ver painel do admin /admin
* R804: Aceitar pedido de remoção de conta /admin
* R805: Ignorar pedido de remoção de conta /admin
* R806: Formulário de ação a membros /admin
* R807: Ação suspensão /admin
* R808: Ação de reativar suspensão /admin
* R809: Ação de banir permanentemente /admin
* R810: Ação de promover a moderador /admin
* R811: Ação de revocar privilegios de moderador /admin

#### R801: Formulário de login admin

|URL |	/adminLogin|
|:---:|:----:|
|Descrição |	Página com formulário para login do Administrador. |
|Método |	GET |
| IU |	[IU016](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu016-p%C3%A1gina-de-login-do-administrador) |
| SUBMIT |	<a href="#r802-ação-de-login-admin">R1005</a>	 |
| Permissões  |	PUB |

#### R802: Ação de login admin

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/adminLogin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que envia uma mensagem definida pelo utilizador para o e-mail definido pelo admin. Redirecciona para a mesma página em qualquer caso e mostra uma notificação de acordo com o sucesso ou insucesso ao enviar a mensagem. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+username: string	</td>
    <td class="tg-yw4l">Username do admin</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+password: string	</td>
    <td class="tg-yw4l">Password do admin</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r801-formulário-de-login-admin">R801</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R803: Ver painel do admin

|URL |	/admin|
|:---:|:----:|
|Descrição |	Obter pedidos de remoção de conta. |
|Método |	GET |
| IU |	[IU015](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu015-painel-do-administrador) |
| Permissões  |	ADM |

#### R804: Aceitar pedido de remoção de conta

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que aceita o pedido de remoção de conta do membro especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>  
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro foi removida com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

#### R805: Ignorar pedido de remoção de conta

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que ignora o pedido de remoção de conta do membro especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>  
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O pedido de remoção da conta do membro foi ignorado com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>


#### R806: Formulário de ação a membros

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Página com um formulário para efetuar várias ações ao utilizador especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+name: string	</td>
    <td class="tg-yw4l">Username do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
  <tr>
</table>

#### R807: Ação suspensão

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que suspende a conta do membro especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>  
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro foi suspensa com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

#### R808: Ação de reativar suspensão

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que reativa a conta de um membro especificado com conta suspensa. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro suspensa foi reativada com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado..</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

#### R809: Ação de banir permanentemente

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que bane a conta do membro especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro foi banida com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

#### R810: Ação de promover a moderador

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que promove a moderador a conta do membro especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro foi promovida a moderador com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Membro com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

#### R811: Ação de revocar privilegios de moderador

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/admin</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que revoca de moderador uma conta do membro especificado anteriormente promovida a moderador. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A conta do membro foi despromovida de moderador com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">A mensagem foi enviada com sucesso.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
</table>

### Módulo 09: Moderação de leilões
* R901: Ver anúncios que aguardam aprovação /moderator
* R902: Ação de aprovar anúncio /moderator
* R903: Ação de reprovar anúncio /moderator
* R904: Ver feedbacks que aguardam aprovação /moderator
* R905: Ação de aprovar feedback /moderator
* R906: Ação de reprovar feedback /moderator

#### R901: Ver anúncios que aguardam aprovação

|URL |	/moderator|
|:---:|:----:|
|Descrição |	Obter pedidos de aprovação do anúncio. |
|Método |	GET |
| IU |	[IU014](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu014-painel-do-moderador) |
| Permissões  |	MDD |

#### R902: Ação de aprovar anúncio

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/moderator</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que aprova um leilão especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do leilão</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r901-ver-anúncios-que-aguardam-aprovação">R901</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r901-ver-anúncios-que-aguardam-aprovação">R901</a> 	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O leilão foi aprovado com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Leilão com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MDD </td>
  </tr>
</table>

#### R903: Ação de reprovar anúncio

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/moderator</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que reprova um leilão especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do leilão</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r901-ver-anúncios-que-aguardam-aprovação">R901</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r901-ver-anúncios-que-aguardam-aprovação">R901</a> 	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O leilão foi reprovado com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Leilão com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MDD </td>
  </tr>
</table>

#### R904: Ver feedbacks que aguardam aprovação
|URL |	/moderator|
|:---:|:----:|
|Descrição |	Obter feedbacks que aguardam aprovação. |
|Método |	GET |
| IU |	[IU014](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu014-painel-do-moderador) |
| Permissões  |	MDD |

#### R905: Ação de aprovar feedback

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/moderator</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que aprova um comentário de feedback especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do leilão</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r904-ver-feedbacks-que-aguardam-aprovação">R904</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r904-ver-feedbacks-que-aguardam-aprovação">R904</a> 	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O comentário de feedback foi aprovado com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Comentário de feedback com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MDD </td>
  </tr>
</table>


#### R906: Ação de reprovar feedback

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/moderator</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que reprova um comentário de feedback especificado. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
    <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do leilão</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r904-ver-feedbacks-que-aguardam-aprovação">R904</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r904-ver-feedbacks-que-aguardam-aprovação">R904</a> 	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O comentário de feedback foi reprovado com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Comentário de feedback com a primary key especificada não encontrado.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MDD </td>
  </tr>
</table>

### Módulo 10: Páginas estáticas
* R1001: Página Sobre /about
* R1002: Questões Frequentes /faq
* R1003: Contactos /contact
* R1004: Formulário contactar /contact
* R1005: Enviar mensagem de contacto /contact

#### R1001 Página Sobre

|URL |	/about|
|:---:|:----:|
|Descrição |	Obter página sobre. |
|Método |	GET |
| IU |	[IU05](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu05-p%C3%A1gina-sobre) |
| Permissões  |	PUB |

#### R1002: Questões Frequentes

|URL |	/faq|
|:---:|:----:|
|Descrição |	Obter página Questões Frequentes. |
|Método |	GET |
| IU |	[IU07](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu07-quest%C3%B5es-frequentes) |
| Permissões  |	PUB |

#### R1003: Contactos

|URL |	/contact|
|:---:|:----:|
|Descrição |	Obter página Contactos. |
|Método |	GET |
| IU |	[IU06](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu06-contactos) |
| Permissões  |	PUB |

#### R1004: Formulário contactar

|URL |	/contact|
|:---:|:----:|
|Descrição |	Página com formulário para contacto. |
|Método |	GET |
| IU |	[IU06](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu06-contactos) |
| SUBMIT |	<a href="#r1005-enviar-mensagem-de-contacto">R1005</a>	 |
| Permissões  |	PUB |

#### R1005: Enviar mensagem de contacto

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/contact</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso que envia uma mensagem definida pelo utilizador para o e-mail definido pelo admin. Redirecciona para a mesma página em qualquer caso e mostra uma notificação de acordo com o sucesso ou insucesso ao enviar a mensagem. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+name: string	</td>
    <td class="tg-yw4l">Nome do utilizador</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+email: string	</td>
    <td class="tg-yw4l">E-mail do utilizador</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+message: string	</td>
    <td class="tg-yw4l">Mensagem do utilizador </td>
  </tr>  
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#r1003-contactos">R1005</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r1003-contactos">R1005</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>


## 4. JSON/XML Types

> Document the JSON or XML responses that will be used by the web resources.

 <!--- Web resources descriptors
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
 -->

***
JSON201 - lista de leilões
JSON202 - valor max bid de um leilão

GROUP1726, 11/4/2018

> Daniel Vieira Azevedo, up201000307@fe.up.pt

> Nelson André Garrido da Costa, up201403128@fe.up.pt

> Rúben José da Silva Torres, up201405612@fe.up.pt

> Tiago Lascasas dos Santos, up201503616@fe.up.pt
