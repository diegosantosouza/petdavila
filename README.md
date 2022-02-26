# Aplicação Pet da vila
Laravel 8 , Bootstrap 4, MySql, JQuery.

## Ambiente Docker
```
app: 
    build: .DockerFile
db:  
    image: mysql:5.7
nginx: 
    image: nginx:1.17-alpine
```

### Dockerfile do aplicativo
> .DockerFile // php:7.4-fpm

### Docker compose (require compose V2)
> .docker-compose.yml

```
### configuração do entrypoint do app
./docker-compose/app/wait-for-it.sh 

### configuração do entrypoint para o db criar as tabelas
./docker-compose/mysql/init_db.sql 

### configuração do Nginx
./docker-compose/nginx/petdavila.conf
```

### Configuração das variáveis de ambiente
> .env
```
APP_NAME=Pet da vila
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_DEVELOPER=diegosantos.s@hotmail.com
APP_VERSION=1.0

LOG_CHANNEL=stack
FILESYSTEM_DRIVER=public

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=exemple
```

## Subindo os containers
Usaremos os comandos do docker-compose para compilar a imagem do aplicativo e executar os serviços que especificamos em nossa configuração.
Compile a imagem do app com o seguinte comando:
```
docker-compose build app
```

Quando a compilação terminar, execute o ambiente em modo de segundo plano com:
```
docker-compose up -d
```

Agora, vá até seu navegador e acesse o nome de domínio ou endereço IP do seu servidor na porta 8080:

http://server_domain_or_IP:8080

Você pode usar o comando logs para verificar os registros gerados por seus serviços:
```
docker-compose logs nginx
```
Para fechar seu ambiente do Docker Compose e remover todos os seus contêineres, redes e volumes, execute:
```
docker-compose down -v
```

## Cadastrando um novo usuário
Por padrão o usuário teste tem os seguintes dados:
```
email = test@mail.com
password = 123456789
```
Rota para criação de usuário:
> http://server_domain_or_IP:8080/register

### Atenção por padrão o novo usuário criado não tem permissões de Administrador, para atribuir privilégios a um usuário você deve acesar o banco de dados disponivel por algum cliente SQL e definir na tabela 'users' coluna 'admin' para 'true' ou 1:
> localhost porta: 3307


#### Dúvidas, Sugestões:
> diegosantos.s26@gmail.com

# Great Developers Never Stop Learning!
