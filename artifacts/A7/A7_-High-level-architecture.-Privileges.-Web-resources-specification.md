# A7: High-level architecture. Privileges. Web resources specification

## 1. Visão geral

Uma visão geral da aplicação web a implementar é apresentada nesta secção, onde os módulos irão ser identificados e brevemente descritos. Os recursos web associeados a cada um dos módulos são descritos em detalhe na documentação individual dos módulos.

| Modules   |      Description      |
|:----------|:-------------|
| M01: Autentificação e perfil individual |  Recursos web associados à autentificação do utilizador e a gestão do perfil individual. Inclui as seguintes funcionalidades: login/logout, registo, recuperação de password, ver e editar a informação do perfil, pedir remoção de conta e vincular e desvincular conta PayPal. |
| M02: Leilões |  Recursos web associados com os leilões. Inclui as seguintes funcionalidades: listagem de leilões, pesquisa, visualização, edição e licitação. |
| M03: Listas do Utilizador autenticado |  Recursos web associados com os as listas de leilões associadas ao Utilizador autenticado. Inclui as seguintes funcionalidades: listagem de favoritos, adição e a sua remoção; listagem de leilões onde o membro participou; leilões criados pelo próprio membro, como vendedor; leilões onde o membro está a participar como comprador.|
| M04: Notificações |   Recursos web associados às notificações e comunicação entre membros. Inclui as seguintes funcionalidades: listagem de notificações, marcação de notificações como lidas, envio de mensagens e visualização de mensagens trocadas com outros membros, visualização, envio e remoção de *feedback*.  |
| M05: Autentificação e área de gestão admin |  Recursos web associados à autentificação e gestão pelo utilizador. Incluí as seguintes funcionalidades: login/logout, suspender/reativar/banir utilizadores, promover/revogar direitos de moderador e aprovar solicitações de remoção de conta. |
| M06: Moderação |  Recursos web associados à moderação de leilões que aguardam aprovação. Incluí as seguintes funcionalidades: listagem de leilões que aguardam aprovação e respetiva aprovação. |
| M07: Páginas estáticas |  Recursos web associados às páginas estáticas: About, FAQ, Contact.  |



## 2. Permissões

Esta secção tem como objetivo definir as permissões usadas nos módulos para estabelecer as condições de acesso aos recursos da aplicação *web*.

|Abreviatura|Tipo      | Permissões|
|:----------:|:-------------:|:-------------|
|PUB|Público      | Grupo de utilizadores sem permissões|
|MMB|Membro       | Utilizadores autenticados           |
|DON|Dono			| Grupo de utilizadores que podem alterar os seus perfis e têm privilégios relativos aos seus leilões |
|MDD|Moderador    | Grupo de utilizadores com permissões para moderar leliões e feedback trocado entre membros da aplicação|
|ADM|Administrador| Administrador da aplicação|

## 3. Módulos

Esta secção documenta todos os recursos web por módulo indicando o *URL*, o método *HTTP*, os seus possíveis parâmetros, interfaces com o utilizador (com referência ao artefacto A3) e a as suas possíveis respostas.

###  Módulo 01: Autentificação e Perfil Individual

Estes são os pontos de extremidade disponíveis no Módulo de Autenticação e Perfil Individual. Dado que todos os formulários são modais sem páginas próprias, são representadas apenas as ações que lhes complementam.

* R101: Ver formulário de login /login
* R102: Ver formulário de registo /register
* R103: Ação de login /login
* R104: Ação de logout /logout
* R105: Ação de registo /register
* R106: Ver perfil /users/{id}
* R107: Ver formulário de edição de perfil /users/{id}/edit
* R108: Ação de editar perfil /users/{id}/edit
* R109: Ver formulário de edição de palavra passe /users/{id}/password/edit
* R110: Ação de editar password /users/{id}/password/edit
* R111: Ver formulário de associação de conta Paypal /users/{id}/paypal/add
* R112: Ação de associação de uma conta PayPal users/{id}/paypal
* R113: Ver formulário de remoção de conta Paypal /users/{id}/paypal/remove
* R114: Ação de remoção de uma conta PayPal users/{id}/paypal


#### R101: Ver formulário de login

|URL |	/login|
|:---|:----|:-------|
|Descrição |	Formulário para realizar o login |
|Método |	GET |
| IU |	Acedido através de uma navbar presente em todas as páginas |
|SUBMIT|R103
| Permissões  |	PUB |

#### R102: Ver formulário de registo

|URL |	/register||
|:---|:----|:-------|
|Descrição |	Formulário para se registar na plataforma |
|Método |	GET |
| IU |	Acedido através de uma navbar presente em todas as páginas |
|SUBMIT|R105
| Permissões  |	PUB |

#### R103: Ação de login

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

#### R104: Ação de logout

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
    <td > R201</td>
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

#### R105: Ação de registo
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
    <td >?address: String	</td>
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
  <td > Redirecciona </td>
    <td > R201 </td>
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

#### R106: Ver perfil
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
  <td >Parâmetros</td>
    <td >+id: Integer</td>
    <td >Chave primária do membro em questão</td>
  </tr>
 <tr>
    <td colspan="2"> IU </td>
    <td > <a href="https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08</a>	</td>
</tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB,ADM</td>
  </tr>
  <tr>
</table>

#### R107: Ver formulário de edição de perfil

|URL |	/users/{id}/edit||
|:---|:----|:-------|
|Descrição |	Formulário para editar a informação do perfil |
|Método |	GET |
| IU |	Modal presente em [IU08](https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08)|
|SUBMIT|R108
| Permissões  |	DON |

#### R108: Ação de editar perfil
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
  <td >Parâmetros</td>
    <td >+id: Integer</td>
    <td >Chave primária do membro em questão</td>
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
    <td >?address: String	</td>
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

#### R109: Ver formulário de edição de palavra passe

|URL |	/users/{id}/password/edit||
|:---|:----|:-------|
|Descrição |	Formulário para editar a palavra passe |
|Método |	GET |
| IU |	Modal presente em [IU08](https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08)|
|SUBMIT|R110
| Permissões  |	DON |

#### R110: Ação de editar password

<table>
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/password/edit</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado para um Membro submeter as edições na sua password. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
  </tr>
  <td >Parâmetros</td>
    <td >+id: Integer</td>
    <td >Chave primária do membro em questão</td>
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

#### R111: Ver formulário de associação da conta Paypal

|URL |	/users/{id}/paypal/add||
|:---|:----|:-------|
|Descrição |	Formulário para associar uma conta Paypal à conta do utilizador |
|Método |	GET |
| IU |	Modal presente em [IU08](https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08)|
|SUBMIT|R112
| Permissões  |	DON |

#### R112: Ação de associação de uma conta PayPal
<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/paypal</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado por um membro para associar uma conta PayPal </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">PUT</td>
  </tr>
  <tr>
  <td >Parâmetros</td>
    <td >+id: Integer</td>
    <td >Chave primária do membro em questão</td>
  </tr>
  <td >Corpo do Pedido</td>
    <td >+paypalEmail: String	</td>
    <td >Email da conta PayPal</td>
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

#### R113: Ver formulário de remoção da conta Paypal

|URL |	/users/{id}/paypal/remove||
|:---|:----|:-------|
|Descrição |	Formulário para desassociar uma conta Paypal à conta do utilizador |
|Método |	GET |
| IU |	Modal presente em [IU08](https://tiagolascasas.github.io/lbaw1726/profile_owner.html">IU08)|
|SUBMIT|R114
| Permissões  |	DON |

#### R114: Ação de remoção de uma conta PayPal
<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/paypal/</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso utilizado por um membro para desassociar uma conta PayPal </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">DELETE</td>
  </tr>
  <tr>
  <td >Parâmetros</td>
    <td >+id: Integer</td>
    <td >Chave primária do membro em questão</td>
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
* R209: API para licitar num leilão /api/bid/{id}
* R210: API para obter o valor da licitação atual /api/bid/{id}

#### R201: Ver página inicial com leilões

|URL |	/home|
|:---|:----|
|Descrição |	Obter a página inicial. |
|Método |	GET |
| IU |	[IU01](https://tiagolascasas.github.io/lbaw1726/home.html) |
|Chamadas Ajax|R203
| Permissões  |	PUB |

#### R202: Página de pesquisa de leilões

|URL |	/search||
|:---|:----|:-------|
|Descrição |	Pesquisa avançada de leilões. |
|Método |	GET |
|Parâmetros|
||?keywords: string | Palavras-chave da pesquisa
||?title: string | Título
||?publisher: string | Editora
||?author: string | Autor
||?isbn: string | ISBN
||?lang: string | Idioma
||?category: string | Categoria
||?maxBid: Float | Valor máximo da licitação atual
| IU |	[IU02](https://tiagolascasas.github.io/lbaw1726/search.html) |
|Chamadas AJAX|R203
| Permissões  |	PUB |

#### R203: API de pesquisa de leilões

|URL |	/api/search||
|:---|:----|:-------|
|Descrição |	Submete uma pesquisa de leilões, retornando JSON com os resultados. É usada extensivamente, não só para pesquisa mas como também para listas pessoais e moderação |
|Método |	GET |
|Parâmetros|
||?keywords: string | Palavras-chave da pesquisa
||?title: string | Título
||?publisher: string | Editora
||?author: string | Autor
||?isbn: string | ISBN
||?lang: string | Idioma
||?category: string | Categoria
||?isApproved: boolean | Leilão aprovado
||?isEnded: boolean | Leilão terminado
||?maxBid: Float | Valor máximo da licitação atual
||?profile_search: string| Pode ser do tipo, "wishlist", "myauctions", "auctions_im_in", "history" ou nulo. Caso seja diferente de nulo o idMember tmb não pode ter valor nulo.
||?idMember: Integer| Id do membro que se pretende pesquisar os leilões aos quais ele está relacionado.
|Corpo da resposta|JSON201
| Permissões  |	PUB |

#### R204: Ver um leilão /auction/{id}

|URL |	/auction/{id}||
|:---|:----|:-------|
|Descrição |	Ver um leilão |
|Método |	GET |
|Parâmetros|+id: Integer| Chave primária de um leilão
| IU |	[IU03](https://tiagolascasas.github.io/lbaw1726/auction.html) |
|Chamadas ajax|R210
| Permissões  |	MMB |

#### R205: Formulário de criação de um leilão

|URL |	/create||
|:---|:----|:-------|
|Descrição |	Formulário para a criação de um novo leilão |
|Método |	GET |
| IU |	[IU04](https://tiagolascasas.github.io/lbaw1726/create.html) |
|SUBMIT|R206
| Permissões  |	MMB |

#### R206: Ação de criação de um leilão

|URL |	/create||
|:---|:----|:-------|
|Descrição |	Cria um novo leilão |
|Método |	POST |
|Corpo do pedido|+title: string | Título
||+publisher: string | Editora
||+author: string | Autor
||+isbn: string | ISBN
||+lang: string | Idioma
||+category: string | Categoria
||+desc: string | Descrição do item
||+img: string | Imagens
|Redirecciona|R204
| Permissões  |	MMB |

#### R207: Formulário de edição de um leilão

|URL |	/editAuction/{id}||
|:---|:----|:-------|
|Descrição |	Formulário para a edição de um leilão existente |
|Método |	GET |
|Parâmetros|+id: Integer| Chave primária de um leilão
| IU | Modal presente em  [IU17](https://tiagolascasas.github.io/lbaw1726/auction_seller.html)|
|SUBMIT|R208
| Permissões  |	VDD |

#### R208: Ação de pedido de edição de um leilão

|URL |	/editAuction/{id}||
|:---|:----|:-------|
|Descrição |	Envia um pedido de edição de um leilão existente |
|Método |	PUT |
|Parâmetros|+id: Integer| Chave primária de um leilão
|Corpo do pedido|+desc: string | Descrição do item
||?img: string | Novas imagens
|Redirecciona|R204
| Permissões  |	VDD |

#### R209: API para licitar num leilão

|URL |	/api/bid/{id}||
|:---|:----|:-------|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	POST |
|Parâmetros|+id: Integer | Chave primária de um leilão
|Corpo do pedido|+userID: Integer | ID do utilizador autenticado
||+value: Float | Nova licitação
|Retorna|200|Licitação concluída com sucesso
||400|Erro especificado no header HTTP
||404|Leilão especificado não existe ou é inválido
| Permissões  |	MMB |

#### R210: API para obter o valor da licitação atual

|URL |	/api/bid/{id}||
|:---|:----|:-------|
|Descrição |	Requisita o valor atual da licitação do leilão especificado |
|Método |	GET |
|Parâmetros|+id: Integer | Chave primária de um leilão
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

|URL |	/wishlist||
|:---|:----|:-------|
|Descrição |	Ver a wishlist do utilizador autenticado |
|Método |	GET |
| IU |	[IU013](https://tiagolascasas.github.io/lbaw1726/wishlist.html) |
|Chamadas Ajax|R203, R210
| Permissões  |	MMB |

#### R302: Ação de adição de um leilão à __wishlist__

|URL |	/wishlist/{id}||
|:---:|:----:|:-------|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	PUT |
|Parâmetros|+id: Integer | Chave primária de um leilão
|Redireciona|R204|Sucesso
||R204|Insucesso
| Permissões  |	MMB |

#### R303: Ação de remoção de um leilão da __wishlist__

|URL |	/wishlist/{id}||
|:---|:----|:-------|
|Descrição |	Aumenta o valor da licitação de um leilão |
|Método |	DELETE |
|Parâmetros|?id: Integer | Chave primária de um leilão
|Redireciona|R301|Sucesso
||R301|Insucesso
| Permissões  |	MMB |

#### R304: Ver o histórico de leilões

|URL |	/history||
|:---|:----|:-------|
|Descrição |	Ver o histórico de leilões completados do utilizador autenticado |
|Método |	GET |
| IU |	[IU012](https://tiagolascasas.github.io/lbaw1726/history.html) |
|Chamadas AJAX|R203
| Permissões  |	MMB, VDD |

#### R305: Ver a lista dos leilões criados

|URL |	/myAuctions||
|:---|:----|:-------|
|Descrição |	Ver a lista dos leilões criados pelo utilizador autenticado |
|Método |	GET |
| IU |	[IU10](https://tiagolascasas.github.io/lbaw1726/myAuctions.html) |
|Chamadas AJAX|R203
| Permissões  |	VDD |

#### R306: Ver a lista dos leilões em que se está a participar

|URL |	/currentAuctions||
|:---|:----|:-------|
|Descrição |	Ver a lista dos leilões ativos em que o utilizador autenticado está a participar |
|Método |	GET |
| IU |	[IU011](https://tiagolascasas.github.io/lbaw1726/auctionsIm_in.html) |
|Chamadas AJAX|R203
| Permissões  |	MMB |

### Módulo 04: Comunicação

Estes são os pontos de extremidade disponíveis no Módulo de Comunicação:

* R401: Ver a lista das notificações não lidas /notifications
* R402: API para listagem de notificações não lidas /api/notifications
* R403: API para marcar notificação como lida /api/notifications/{id}
* R404: Ver Mensagens /messages/{id}
* R405: Formulário para criar Mensagem /messages/{id}/new_message
* R406: Acção para criar Mensagem /messages/{id}/new_message
* R407: Ação para listar comentários /users/{id}/comments
* R408: Acção para criar comentário /users/{id}/comments
* R409: Ação de reprovar comentário /users/{id}/comments/remove

#### R401: Ver a lista das notificações não lidas

|URL |	/notifications||
|:---|:----|:-------|
|Descrição |	Ver a lista das notificações não lidas |
|Método |	GET |
| IU | Dropdown presente na navbar de todas as páginas |
|Chamadas AJAX|R402, R403
| Permissões  |	DON |

#### R402: API para listagem de notificações não lidas
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/notifications</td>
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
    <td colspan="2">JSON401</td>
   </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> DON </td>
   </tr>
</table>


#### R403: API para marcar notificação como lida
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/notifications/{id}</td>
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
    <td  colspan="2"> DON </td>
  </tr>
</table>

#### R404: Ver Mensagens
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages/{id}</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Obter todas as mensagens relacionadas com o utilizador autenticado</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
   </tr>
   <tr>
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária do membro autenticado</td>
   </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>


#### R405:  Formulário criar Mensagem
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages/{id}/new_message</td>
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
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária do membro autenticado</td>
   </tr>
   <tr>
    <td colspan="2">Submit </td>
    <td >R406</td>
   </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
  </tr>
</table>

#### R406: Acção para criar Mensagem

<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/messages/{id}/new_message</td>
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
     <td >Parâmetros</td>
     <td >+id: Integer	</td>
     <td >Chave primária do membro autenticado</td>
   </tr>
   <tr>
    <td >Corpo do pedido</td>
    <td >+message_text: text	</td>
    <td >Corpo da mensagem</td>
  </tr>
 <tr>
    <td ></td>
    <td >+idReceiver: Integer	</td>
    <td >Chave primária do membro a quem foi enviada a mensagem</td>
   </tr>

    <tr>
  <td > Redirecciona </td>
    <td >R404	</td>
    <td > Sucesso</td>
  </tr>  
    <tr>
  <td >  </td>
     <td > R404	</td>
    <td > Insucesso </td>
  </tr>
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>

#### R407: Ver lista de comentários
<table>
   <tr>
    <td  colspan="2">URL</td>
    <td colspan="2">/users/{id}/comments</td>
   </tr>
   <tr>
    <td colspan="2">Descrição</td>
    <td colspan="2">Obter todas os comentários no perfil de um membro especificado</td>
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
    <td colspan="2">IU</td>
    <td colspan="2"> [IU08](https://tiagolascasas.github.io/lbaw1726/profile_owner.html) </td>
   </tr>
   <tr>
    <td colspan="2">Permissões</td>
    <td colspan="2"> MMB </td>
   </tr>
</table>

#### R405:  Formulário para criar um comentário
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/comments</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Formulário de criação de um comentário</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">GET</td>
   </tr>
   <tr>
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária do dono do perfil</td>
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
    <td colspan="2">Submit </td>
    <td >R408</td>
   </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
  </tr>
</table>

#### R408: Acção para criar comentário
<table >
   <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id}/comments</td>
   </tr>
   <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2">Cria uma novo comentário no perfil de um membro especificado.</td>
   </tr>
   <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">POST</td>
   </tr>
   <tr>
    <td >Parâmetros</td>
    <td >+id: Integer	</td>
    <td >Chave primária do dono do perfil</td>
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
    <td >Redireciona</td>
    <td >R407	</td>
    <td >Sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >R407</td>
    <td >Insucesso</td>
  </tr>  
   <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MMB </td>
   </tr>
</table>

#### R409: Ação de remover comentário

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/users/{id_usr}/comments/{id_comm}remove</td>
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
   <td >Parâmetros</td>
   <td >+id_usr: Integer	</td>
   <td >Chave primária do membro</td>
  </tr>
  <tr>
   <td ></td>
   <td >+id_comm: Integer	</td>
   <td >Chave primária do comentário</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do comentário</td>
  </tr>
  <tr>
    <td >Redireciona</td>
    <td >R407	</td>
    <td >Sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >R407</td>
    <td >Insucesso</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>

### Módulo 05: Autentificação e área de gestão admin

Estes são os pontos de extremidade disponíveis no Módulo de Autenticação e área de gestão admin:
* R501: Formulário de login admin /adminLogin
* R502: Ação de login admin /adminLogin
* R503: Ver painel do admin /admin
* R504: API para aceitar um pedido de remoção de conta /api/admin/terminate
* R505: API para ignorar um pedido de remoção de conta /api/admin/ignore
* R506: API para suspender um utilizador /api/admin/suspend
* R507: API para reativar um utilizador /api/admin/reactivate
* R508: API para banir permanentemente /api/admin/ban
* R509: API para promover a moderador /api/admin/promote_moderator
* R510: API parae revocar privilegios de moderador /api/admin/remoke_moderator

#### R501: Formulário de login admin

|URL |	/adminLogin|
|:---:|:----:|
|Descrição |	Página com formulário para login do Administrador. |
|Método |	GET |
| IU |	[IU016](https://tiagolascasas.github.io/lbaw1726/adminLogin.html) |
| SUBMIT |R502	 |
| Permissões  |	PUB |

#### R502: Ação de login admin

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
    <td > R503 	</td>
    <td > Sucesso</td>
  </tr>  
    <tr>
  <td >  </td>
     <td > R501	</td>
    <td > Insucesso </td>
  </tr>  
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> PUB </td>
  </tr>
  <tr>
</table>

#### R503: Ver painel do admin

|URL |	/admin|
|:---:|:----:|
|Descrição |	Obter pedidos de remoção de conta. |
|Método |	GET |
| IU |	[IU015](https://tiagolascasas.github.io/lbaw1726/admin.html) |
|Chamadas AJAX| R504, R505, R506, R507, R508, R509, R510
| Permissões  |	ADM |

#### R504: API para aceitar um pedido de remoção de conta

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/terminate</td>
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

#### R505: API para ignorar um pedido de remoção de conta

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/ignore</td>
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

#### R506: API para suspender um utilizador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/suspend</td>
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

#### R507: API para reativar um utilizador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/reactivate</td>
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

#### R508: API para banir permanentemente

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/ban</td>
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

#### R509: API para promover a moderador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/promote_moderator</td>
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

#### R510: API para revogar privilégios de moderador

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/admin/revoke_moderator</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que revoga de moderador uma conta do membro especificado anteriormente promovida a moderador. </td>
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

### Módulo 06: Moderação de leilões

Estes são os pontos de extremidade disponíveis no Módulo de Moderação de leilões:
* R601: Ver anúncios que aguardam aprovação /moderator
* R602: API para aprovar um anúncio /api/moderator/approve_auction
* R603: API para reprovar um anúncio /api/moderator/remove_auction
* R604: Ver pedidos de edição de um anúncio /modifications
* R605: API para aprovar a modificação de um anúncio /api/moderator/approve_modification
* R606: API para rejeitar a modificação de um anúncio /api/moderator/reject_modification

#### R601: Ver anúncios que aguardam aprovação

|URL |	/moderator|
|:---|:----|
|Descrição |	Obter pedidos de aprovação do anúncio. |
|Método |	GET |
| IU |	[IU014](https://tiagolascasas.github.io/lbaw1726/moderator.html) |
|Chamadas AJAX|R203|
| Permissões  |	MDD |

#### R602: API para aprovar um anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/moderator/approve_auction</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que aprova um leilão especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">PUT</td>
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

#### R603: API para reprovar um anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api/moderator/remove_auction</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que reprova um leilão especificado. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">PUT</td>
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

#### R604: Ver pedidos de edição de um anúncio

|URL |	/modifications|
|:---|:----|
|Descrição |	Obter pedidos de aprovação do anúncio. |
|Método |	GET |
| IU |	[IU014](https://tiagolascasas.github.io/lbaw1726/review_modifications.html) |
|Chamadas AJAX|R203|
| Permissões  |	MDD |

#### R605: API para aprovar a modificação de um anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api//moderator/approve_modification</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que aprova um pedido de modificação de um leilão. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">PUT</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do pedido de modificação</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O pedido foi aprovado com sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Pedido com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>

#### R606: API para rejeitar a modificação de um anúncio

<table >
  <tr>
    <td  colspan="2">URL</td>
    <td  colspan="2">/api//moderator/reject_modification</td>
  </tr>
  <tr>
    <td  colspan="2">Descrição</td>
    <td  colspan="2"> Recurso que rejeita um pedido de modificação de um leilão. </td>
  </tr>
  <tr>
    <td  colspan="2">Método</td>
    <td  colspan="2">DELETE</td>
  </tr>
  <tr>
    <td > Corpo do pedido </td>
    <td > +id: integer </td>
    <td > Id do pedido de modificação</td>
  </tr>
  <tr>
    <td >Retorna</td>
    <td >200 OK	</td>
    <td >O pedido foi rejeitado com sucesso</td>
  </tr>  
  <tr>
    <td ></td>
    <td >400 Pedido Incorreto	</td>
    <td >Mensagem de erro é especificada via HTTP header.</td>
  </tr>  
  <tr>
    <td ></td>
    <td >404 Não encontrado.	</td>
    <td >Pedido com a chave primária especificada não encontrado.</td>
  </tr>
  <tr>
    <td  colspan="2">Permissões</td>
    <td  colspan="2"> MDD </td>
  </tr>
</table>


### Módulo 07: Páginas estáticas

Estes são os pontos de extremidade disponíveis no Módulo de Páginas Estáticas:
* R701: Página Sobre /about
* R702: Questões Frequentes /faq
* R703: Contactos /contact
* R704: Enviar mensagem de contacto /contact

#### R701 Página Sobre

|URL |	/about|
|:---:|:----:|
|Descrição |	Obter página sobre. |
|Método |	GET |
| IU |	[IU05](https://tiagolascasas.github.io/lbaw1726/about.html) |
| Permissões  |	PUB |

#### R702: Questões Frequentes

|URL |	/faq|
|:---:|:----:|
|Descrição |	Obter página Questões Frequentes. |
|Método |	GET |
| IU |	[IU07](https://tiagolascasas.github.io/lbaw1726/faq.html) |
| Permissões  |	PUB |

#### R703: Contactos

|URL |	/contact|
|:---:|:----:|
|Descrição |	Obter página Contactos. |
|Método |	GET |
| IU |	[IU06](https://tiagolascasas.github.io/lbaw1726/contact.html) |
|Chamadas AJAX|R704
| Permissões  |	PUB |

#### R704: Enviar mensagem de contacto

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
```
{
    "auctionID": "1",
    "currentMaxBid": "7.16"
}
```

JSON401: Lista de notificações
```
{
  "notification": [
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

## Histórico de revisões

Mudanças feitas à primeira submissão:
1. Removidos retornos errados em recursos não AJAX, substituindo-os por redirecionamentos;
2. Adicionados recursos referentes a elementos contidos numa navbar presente em todas as páginas, em especial no módulo 1;
3. Foi corrigidas algumas chamadas entre formulários, ações e AJAX, em particular no módulo do moderador e administrador;
4. Agregação dos módulos da comunicação e das notificações num só;
5. Remoção de JSON desnecessário;
6. Corrigidos parâmetros opcionais que tinham sido marcados como obrigatórios

***

GROUP1726, 11/4/2018

> Daniel Vieira Azevedo, up201000307@fe.up.pt

> Nelson André Garrido da Costa, up201403128@fe.up.pt

> Rúben José da Silva Torres, up201405612@fe.up.pt

> Tiago Lascasas dos Santos, up201503616@fe.up.pt
