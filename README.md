## Seleção Backend - Betalabs

Teste de seleção para a vaga de Backend

## Conceitos

Por ser algo simples, não julguei interessante criar abstrações, serviços ou qualquer estrutura complexa para resolver problemas com pouca regras de negócios. Optei por resolver tudo no controller, mas de forma elegante.

## Soluções

- **[Usuários]**: [Criação e edição de usuários foram todas resolvidas no **App\Http\Controllers\API\UserController** E as regras de negócioa resolvidas na query ou no Sanctum com a autenticação]
- .
- **[Comentários]**: [Gerenciamento de comentários, incluindo deleção, foram todos resolvidos dentro o **App\Http\Controllers\API\UserController** ] uma ressalva abaixo para a rota administrativa não contemplada.
- .
- **[Autenticação]**: [Resolvidacom o Laravel\Sanctum]
- .

## Teste unitários

Eu não fiz teste unitário propriamente dito, porque isso consistiria em instanciar as classes e testar método por método, mas eu fiz o teste de integração, chamando a API e testando os fluxos todos, mas foi feito com o PHPUnit como especificado

## O que não contemplei

Deixei de contemplar a rota administrativa de deletar qualquer comentário pela complexidade de criar uma estrutura interessante de Autenticação e Politicas do Sanctum.

Eu poderia ter feito uma FLAG dentor do usuário e criar uma politica dessa maneira, mas precisaria da rota de tornar alguem admin, teria qeu fazer factory de admin e testes a parte.
