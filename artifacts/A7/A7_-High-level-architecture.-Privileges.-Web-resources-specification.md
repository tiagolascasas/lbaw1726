# A7: High-level architecture. Privileges. Web resources specification

## 1. Visão geral

Uma visão geral da aplicação web a implementar é apresentada nesta secção, onde os módulos irão ser identificados e brevemente descritos. Os recursos web associeados a cada um dos módulos são descritos em detalhe na documentação individual dos módulos.

| Modules   |      Description      |
|:----------|-------------:|
| M01: Autentificação e perfil individual |  Recursos web associados à autentificação do utilizador e a gestão do perfil individual. Inclui as seguintes funcionalidades: login/logout, registo, recuperação de password, ver e editar a informação do perfil, pedir remoção de conta e vincular e desvincular conta PayPal. |
| M02: Leilões |  Recursos web associados com os leilões. Inclui as seguintes funcionalidades: listagem de leilões, pesquisa, visualização, edição e licitação. |
| M03: Listas do Utilizador autenticado |  Recursos web associados com os as listas de leilões associadas ao Utilizador autenticado. Inclui as seguintes funcionalidades: listagem de favoritos, adição e a sua remoção; listagem de leilões onde o membro participou; leilões criados pelo próprio membro, como vendedor; leilões onde o membro está a participar como comprador.|
| M04: Notificações |   Recursos web associados às notificações. Inclui as seguintes funcionalidades: listagem de notificações e marcação noficações como lidas.  |
| M05: Comunicação entre membros |   Recursos web associados às mensagens. Inclui as seguintes funcionalidades: envio de mensagens e visualização de mensagens trocadas com outros membros  |
| M06: Autentificação e área de gestão admin |  Recursos web associados à autentificação e gestão pelo utilizador. Incluí as seguintes funcionalidades: login/logout, suspender/reativar/banir utilizadores, promover/revogar direitos de moderador e aprovar solicitações de remoção de conta. |
| M07: Moderação |  Recursos web associados à moderação de leilões que aguardam aprovação. Incluí as seguintes funcionalidades: listagem de leilões que aguardam aprovação e respetiva aprovação e remoção de *feedback* ofensivo. |
| M8: Páginas estáticas |  Recursos web associados às páginas estáticas: About, FAQ, Contact.  |



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
* R109: Formulário de editar password /users/{id}/password/reset
* R110: Ação de editar password users/{id}/password/edit

#### R101: Formulário de login

|URL |	/login|
|:---:|:----:|
|Descrição |	Página com formulário para login do Utilizador. |
|Método |	GET |
| IU |	[IU19](blob:https://imgur.com/fdb90891-3de5-4d38-9c01-1de3711b1a91) |
| SUBMIT |	<a href="https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A7/A7_-High-level-architecture.-Privileges.-Web-resources-specification.md#r102-a%C3%A7%C3%A3o-de-login">R102</a>	 |
| Permissões  |	PUB |

#### R102: Ação de login

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/login</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado para um utilizador realizar a ação de login. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+username: String	</td>
    <td class="tg-yw4l">Username do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+password: String	</td>
    <td class="tg-yw4l">Password do membro</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#">R201</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r101-formulário-de-login">R101</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R103: Ação de logout

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/logout</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado para um utilizador, membro ou administrador, realizar a ação de logout. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#">R201</a></td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB, ADM </td>
  </tr>
  <tr>
</table>

#### R104: Formulário de registo

|URL |	/register|
|:---:|:----:|
|Descrição |	Página com formulário para um Visitante realizar o seu registo na aplicação. |
|Método |	GET |
| IU |	[IU20](blob:https://i.imgur.com/jSZXxwi.jpg) |
| SUBMIT |	<a href="https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A7/A7_-High-level-architecture.-Privileges.-Web-resources-specification.md#r105-a%C3%A7%C3%A3o-de-registo">R105</a>	 |
| Permissões  |	PUB |

#### R105: Ação de registo
<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/register</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado para um visitante conseguir registar-se na aplicação. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+name: String	</td>
    <td class="tg-yw4l">Nome completo do visitante que se regista.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+username: String	</td>
    <td class="tg-yw4l">username do visitante que se regista.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+age: Integer	</td>
    <td class="tg-yw4l">Idade do visitante que se regista.</td>
  </tr>
  <tr>
   <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+email: String	</td>
    <td class="tg-yw4l">E-mail do visitante que se regista.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+address: String	</td>
    <td class="tg-yw4l">Morada do visitante que se regista.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+postalcode: Integer	</td>
    <td class="tg-yw4l">Código postal do visitante que se regista.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+phonenumber: Integer	</td>
    <td class="tg-yw4l">Número telefónico do visitante que se regista.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+password: String	</td>
    <td class="tg-yw4l">Password do visitante que se regista</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+confirmPassword: String	</td>
    <td class="tg-yw4l">Password de confirmação do visitante que se regista</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="#">R201</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r104-formulário-de-registo">R101</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R106: Ver perfil
<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/users/{id}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado por um Membro para aceder à sua página de perfil. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">GET</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Parâmetros </td>
    <td class="tg-yw4l"> +id: Integer</td>
    <td class="tg-yw4l"> Chave primária de Utilizador</td>
  </tr>
 <tr>
    <td class="tg-yw4l"> IU </td>
    <td class="tg-yw4l"> <a href="https://i.imgur.com/ybbFdZX.png">IU08</a>	</td>
</tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB</td>
  </tr>
  <tr>
</table>

#### R107: Formulário de editar perfil
|URL |	/user/{id}/edit|
|:---:|:----:|
|Descrição |	Página com campos de edição da informação do Membro. |
|Método |	GET |
| IU |	[IU17](blob:https://imgur.com/52473f91-99b5-4a08-993a-2b4b1fb435c6) |
| SUBMIT |	<a href="#r108-ação-de-editar-perfil">R108</a>	 |
| Permissões  |	MMB |

#### R108: Ação de editar perfil
<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/users/{id}/edit</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado para um Membro submeter as edições na informação do seu perfil. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Request body</td>
    <td class="tg-yw4l">+name: String	</td>
    <td class="tg-yw4l">Nome completo do Membro.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+age: Integer	</td>
    <td class="tg-yw4l">Idade do Membro.</td>
  </tr>
  <tr>
   <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+email: String	</td>
    <td class="tg-yw4l">E-mail do Membro.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+address: String	</td>
    <td class="tg-yw4l">Morada do Membro.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+postalcode: Integer	</td>
    <td class="tg-yw4l">Código postal do Membro.</td>
  </tr>
 <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+phonenumber: Integer	</td>
    <td class="tg-yw4l">Número telefónico do Membro.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+country: String	</td>
    <td class="tg-yw4l">País do Membro.</td>
 </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="https://i.imgur.com/ybbFdZX.png">IU08</a>	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r105-formulário-de-editar-perfil">R107</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R109: Formulário de editar password
|URL |	/users/{id}/password/reset|
|:---:|:----:|
|Descrição |	Página com campos de edição da password do Membro. |
|Método |	GET |
| IU |	[IU18](blob:https://imgur.com/3739886b-2dfc-4fd8-ad66-ab585646a03b) |
| SUBMIT |	<a href="#r110-ação-de-editar-password">R110</a>	 |
| Permissões  |	MMB |

#### R110: Ação de editar password
<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/users/{id}/password/reset</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2"> Recurso utilizado para um Membro submeter as edições na sua password. </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
  </tr>
  <tr>
  <td class="tg-yw4l">Corpo do Pedido</td>
    <td class="tg-yw4l">+oldPassword: String	</td>
    <td class="tg-yw4l">Password atual do Membro.</td>
  </tr>
   <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+newPassword: String	</td>
    <td class="tg-yw4l">Nova password do Membro.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> </td>
    <td class="tg-yw4l">+confirmNewPassword: String	</td>
    <td class="tg-yw4l">Confirmação da nova password do Membro.</td>
  </tr>
  <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l"> <a href="https://i.imgur.com/ybbFdZX.png">IU08</a>	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r105-formulário-de-editar-password">R109</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
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

### Módulo 04: Notificações

* R501: Acção listagem de notificações não lidas.
* R502: Acção marcar notificação como lida.

#### R401: Acção listagem de notificações não lidas
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/notifications</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Recurso que busca todas as notificações não lidas de um utilizador</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">GET</td>
   </tr>
   <tr>
    <td class="tg-yw4l"colspan="2">Parâmetros</td>
    <td class="tg-yw4l">+id: Integer	</td>
    <td class="tg-yw4l">member primary key</td>
   </tr>
   <tr>
    <td class="tg-yw4l">Corpo da resposta</td>
    <td class="tg-yw4l"colspan="2">JSON501</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
   </tr>
</table>


#### R402: Acção marcar notificação como lida.
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/notifications</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Recurso usado para marcar uma notificação como lida</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
   </tr>
   <tr>
    <td class="tg-yw4l">Corpo do pedido</td>
    <td class="tg-yw4l">+id_member: Integer	</td>
    <td class="tg-yw4l">member primary key</td>
   </tr>
   <tr>
    <td class="tg-yw41"></td>
    <td class="tg-yw4l">+id_notification: Integer	</td>
    <td class="tg-yw4l">notification primary key</td>
   </tr>
   <tr>
   <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">A notificação foi marcada como lida com sucesso.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">400 Pedido Incorreto	</td>
    <td class="tg-yw4l">Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">404 Não encontrado.	</td>
    <td class="tg-yw4l">Notificação com a primary key especificada não encontrada.</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
  </tr>
</table>

### Módulo 05: Comunicação entre membros
* R601: Ver Mensagens /messages
* R602: Formulário para criar Mensagem /messages/new_message
* R603: Acção para criar Mensagem /messages
* R604: Ver comentários /comments
* R605: Acção para criar comentário /comments
* R606: Ação de reprovar comentário /comments/remove

#### R501: Ver Mensagens
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/messages</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Obter todas as mensagens relacionadas com o membro em questão</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">GET</td>
   </tr>
   <tr>
    <td class="tg-yw4l"colspan="2">Parâmetros</td>
    <td class="tg-yw4l">+id: Integer	</td>
    <td class="tg-yw4l">member primary key</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Corpo da resposta</td>
    <td class="tg-yw4l">JSON601</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
   </tr>
</table>


#### R502:  Formulário criar Mensagem .
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/messages/new_message</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Página com um form para enviar uma mensagem</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">GET</td>
   </tr>
   <tr>
    <td class="tg-yw4l"colspan="2">Submit </td>
    <td class="tg-yw4l">R603</td>
   </tr>
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
  </tr>
</table>

#### R503: Acção para criar Mensagem /messages .
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">/messages</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Cria uma nova mensagem. Redireciona para a nova página de mensagens em caso de sucesso ou para um novo formulário de nova mensagem em caso de insucesso</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
   </tr>
   <tr>
    <td class="tg-yw4l">Corpo do pedido</td>
    <td class="tg-yw4l">+message_text: text	</td>
    <td class="tg-yw4l">Corpo da mensagem</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">+idSender: Integer	</td>
    <td class="tg-yw4l">primary key do membro que enviou a mensagem</td>
  </tr>
 <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">+idReceiver: Integer	</td>
    <td class="tg-yw4l">primary key do membro que recebe a mensagem</td>
   </tr>
    <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l">R601	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> R602	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
   </tr>
</table>

#### R504: Acção para criar comentário /comments .
<table class="tg">
   <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">profile_not_owner/{id}/comments</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Descrição</td>
    <td class="tg-yw4l" colspan="2">Cria uma novo comentário no perfil do membro em questão.</td>
   </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Método</td>
    <td class="tg-yw4l" colspan="2">POST</td>
   </tr>
   <tr>
    <td class="tg-yw4l">Corpo do pedido</td>
    <td class="tg-yw4l">+liked: boolean	</td>
    <td class="tg-yw4l">Comentário positivo ou negativo</td>
  </tr>
   <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">+comment_text: text	</td>
    <td class="tg-yw4l">Corpo do comentário</td>
  </tr>
   <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">+idSender: Integer	</td>
    <td class="tg-yw4l">primary key do membro que enviou o comentário</td>
  </tr>
   <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">+idReceiver: Integer	</td>
    <td class="tg-yw4l">primary key do membro que recebeu o comentário</td>
   </tr>
    <tr>
  <td class="tg-yw4l"> Redirecciona </td>
    <td class="tg-yw4l">R601	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> R602	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>
   <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> MMB </td>
   </tr>
</table>

#### R505: Ação de reprovar comentário

<table class="tg">
  <tr>
    <td class="tg-yw4l" colspan="2">URL</td>
    <td class="tg-yw4l" colspan="2">profile_not_owner/{id}/comments/remove</td>
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
    <td class="tg-yw4l"> Corpo do pedido </td>
    <td class="tg-yw4l"> +id: integer </td>
    <td class="tg-yw4l"> Id do comentário</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Retorna</td>
    <td class="tg-yw4l">200 OK	</td>
    <td class="tg-yw4l">O comentário de feedback foi removido com sucesso.</td>
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

### Módulo 06: Autentificação e área de gestão admin
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

#### R601: Formulário de login admin

|URL |	/adminLogin|
|:---:|:----:|
|Descrição |	Página com formulário para login do Administrador. |
|Método |	GET |
| IU |	[IU016](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu016-p%C3%A1gina-de-login-do-administrador) |
| SUBMIT |	<a href="#r602-ação-de-login-admin">R602</a>	 |
| Permissões  |	PUB |

#### R602: Ação de login admin

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r601-formulário-de-login-admin">R601</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R603: Ver painel do admin

|URL |	/admin|
|:---:|:----:|
|Descrição |	Obter pedidos de remoção de conta. |
|Método |	GET |
| IU |	[IU015](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu015-painel-do-administrador) |
| Permissões  |	ADM |

#### R604: Aceitar pedido de remoção de conta

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

#### R605: Ignorar pedido de remoção de conta

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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


#### R606: Formulário de ação a membros

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> ADM </td>
  </tr>
  <tr>
</table>

#### R607: Ação suspensão

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

#### R608: Ação de reativar suspensão

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

#### R609: Ação de banir permanentemente

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
    <td class="tg-yw4l"> <a href="#r803-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

#### R610: Ação de promover a moderador

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

#### R611: Ação de revocar privilegios de moderador

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
    <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r603-ver-painel-do-admin">R603</a>	</td>
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

### Módulo 07: Moderação de leilões
* R901: Ver anúncios que aguardam aprovação /moderator
* R902: Ação de aprovar anúncio /moderator
* R903: Ação de reprovar anúncio /moderator

#### R701: Ver anúncios que aguardam aprovação

|URL |	/moderator|
|:---:|:----:|
|Descrição |	Obter pedidos de aprovação do anúncio. |
|Método |	GET |
| IU |	[IU014](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu014-painel-do-moderador) |
| Permissões  |	MDD |

#### R702: Ação de aprovar anúncio

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
    <td class="tg-yw4l"> <a href="#r701-ver-anúncios-que-aguardam-aprovação">R701</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r701-ver-anúncios-que-aguardam-aprovação">R701</a> 	</td>
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

#### R703: Ação de reprovar anúncio

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
    <td class="tg-yw4l"> <a href="#r701-ver-anúncios-que-aguardam-aprovação">R701</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"><a href="#r701-ver-anúncios-que-aguardam-aprovação">R701</a> 	</td>
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



### Módulo 08: Páginas estáticas
* R1001: Página Sobre /about
* R1002: Questões Frequentes /faq
* R1003: Contactos /contact
* R1004: Formulário contactar /contact
* R1005: Enviar mensagem de contacto /contact

#### R801 Página Sobre

|URL |	/about|
|:---:|:----:|
|Descrição |	Obter página sobre. |
|Método |	GET |
| IU |	[IU05](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu05-p%C3%A1gina-sobre) |
| Permissões  |	PUB |

#### R802: Questões Frequentes

|URL |	/faq|
|:---:|:----:|
|Descrição |	Obter página Questões Frequentes. |
|Método |	GET |
| IU |	[IU07](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu07-quest%C3%B5es-frequentes) |
| Permissões  |	PUB |

#### R803: Contactos

|URL |	/contact|
|:---:|:----:|
|Descrição |	Obter página Contactos. |
|Método |	GET |
| IU |	[IU06](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu06-contactos) |
| Permissões  |	PUB |

#### R804: Formulário contactar

|URL |	/contact|
|:---:|:----:|
|Descrição |	Página com formulário para contacto. |
|Método |	GET |
| IU |	[IU06](https://github.com/tiagolascasas/lbaw1726/blob/master/artifacts/A3/A3.md#iu06-contactos) |
| SUBMIT |	<a href="#r805-enviar-mensagem-de-contacto">R805</a>	 |
| Permissões  |	PUB |

#### R805: Enviar mensagem de contacto

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
    <td class="tg-yw4l"> <a href="#r803-contactos">R803</a> 	</td>
    <td class="tg-yw4l"> Sucesso</td>
  </tr>  
    <tr>
  <td class="tg-yw4l">  </td>
     <td class="tg-yw4l"> <a href="#r803-contactos">R803</a>	</td>
    <td class="tg-yw4l"> Insucesso </td>
  </tr>  
  <tr>
    <td class="tg-yw4l" colspan="2">Permissões</td>
    <td class="tg-yw4l" colspan="2"> PUB </td>
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
