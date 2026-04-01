#Ranking de Movimento - Desafio Tecnico

A referida API foi desenvolvida como um desafio técnico para gerenciar o ranking de PR's de alguns movimentos.

#Processo de desenvolvimento

O projeto foi pensado para ser executado em um ambiente utilizando Docker para ser funcional e independente do ambiente (servidor local ou docker).

Ambiente Local:
Na fase de desenvolvimento foi utilizado um ambiente local Laragon em razão da praticidade.

Teste do Docker:
Para teste, na falta do Docker Desktop, foi utilizado o Killerkoda para simulação da montagem do container e teste da API.

##COMO RODAR O PROJETO##

Para (tentar) facilitar a avaliação e evitar problemas de rotas e conexões, o ambiente foi configurado via Docker Compose e para rodá-lo é necessário:

1. INSTALAR O DOCKER E DOCKER COMPOSE

Ter instalado o Docker (v20.10+) e o Docker Compose (v2.0+) (Docker Desktop para Windows ou Mac já contempla ambos. Para Linux é comum ter que instalá-los separadamente);

2. MONTAR O DOCKER NO TERMINAL DO SO

Abrir o terminal do próprio SO, na pasta raiz do projeto, e executar o comando abaixo para criar a imagem PHP+MySQL necessárias:
`docker-compose up -d --build`

- O script SQL de criação de tabelas e inserção de dados de teste está localizado em database/init.sql. O Docker irá executá-lo automaticamente na primeira inicialização.

3. ACESSAR A API 

Após os containers estarem "Up", aduardar um instante para que o script SQL crie as tabelas e insira os dados necessários e então acessar:

Nota: O MySQL pode levar cerca de 30 segundos para processar o arquivo init.sql na primeira subida. Se o link retornar erro de imediato, aguarde um instante e dê F5.

http://localhost:8080/index.php?movimento=1

movimento=1: Ranking para Deadlift

movimento=2: Ranking para Back Squat

movimento=3: Ranking para Bench Press


4. Comandos Úteis

Verificar logs: 

`docker logs -f tecnotask_app`

Parar a aplicação: 

`docker-compose down`

Reset total (Limpar banco e reiniciar): 

`docker-compose down -v && docker-compose up -d`


###Lógica do Ranking e empates

- Para implementar a regra de negócio e seguir os requisitos passados utilizei recursos nativos do MySQL 8 - Window Functions ROW_NUMBER e CTEs para garantir que apenas o maior record de cada usuário fosse obtido.

O ranking agrupa os usuários por movimento e os organiza em posições. Em caso de empate, os usuários ocupam a mesma posição.



