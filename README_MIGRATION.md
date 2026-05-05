# Migração Anime Rate para PHP MVC

Este projeto foi migrado de uma estrutura estática (HTML/JS) para uma arquitetura profissional em PHP Puro com SQLite.

## Estrutura do Projeto
- **config/**: Configurações do sistema (config.ini).
- **core/**: Classes base (Database, Exception).
- **interfaces/**: Contratos (IEntityRepository).
- **models/**: Entidades de negócio (Anime).
- **repositories/**: Acesso ao banco de dados (PDO).
- **services/**: Regras de negócio.
- **controllers/**: Orquestração de requisições.
- **routes/**: Middlewares e segurança.
- **views/**: Interface do usuário (PHP + HTML).
- **index.php**: Front Controller / Roteador.

## Como Executar
1. Certifique-se de ter o PHP 8+ instalado com suporte a PDO SQLite.
2. No terminal, na raiz do projeto, execute:
   ```bash
   php -S localhost:8000
   ```
3. Acesse `http://localhost:8000` no seu navegador.

## Banco de Dados
O banco de dados SQLite é gerado automaticamente. Caso precise reinicializar:
```bash
php database/init_db.php
```

## Observações
- A interface original foi preservada e adaptada para PHP.
- Foram implementadas proteções contra XSS e sanitização de entradas.
- O padrão Repository e Injeção de Dependência foram aplicados conforme solicitado.
