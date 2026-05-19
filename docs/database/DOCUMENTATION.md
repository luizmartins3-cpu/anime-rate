# Documentação da Arquitetura de Dados - Anime Rate

Este documento detalha a modelagem relacional do banco de dados do projeto **Anime Rate**, seguindo padrões acadêmicos de normalização e boas práticas de engenharia de software.

## 1. Entidades Principais

*   **Users (Usuários):** Armazena informações de autenticação e perfil dos usuários.
*   **Animes:** Entidade central que contém os detalhes técnicos, sinopse e mídia das obras.
*   **Genres (Gêneros):** Tabela de domínio para categorização dos animes (Ação, Shounen, etc).
*   **Reviews (Avaliações):** Registra as notas e comentários dos usuários sobre obras específicas.
*   **Favorites (Favoritos):** Tabela de ligação para a funcionalidade de lista de desejos/favoritos.

## 2. Modelagem e Normalização

O banco de dados foi projetado respeitando as Formas Normais (1NF, 2NF e 3NF):

*   **1NF:** Ausência de grupos repetitivos e atributos multivalorados (ex: gêneros extraídos para tabela própria).
*   **2NF:** Todos os atributos não-chave dependem totalmente da chave primária (PK).
*   **3NF:** Não existem dependências transitivas entre atributos não-chave.

### Relacionamentos

*   **Anime <-> Genres (N:N):** Implementado via tabela associativa `anime_genres`. Um anime pode ter vários gêneros e um gênero pertence a vários animes.
*   **User <-> Anime (Favorites) (N:N):** Implementado via tabela `favorites`. Permite que usuários salvem múltiplos animes e animes sejam salvos por múltiplos usuários.
*   **User -> Reviews -> Anime (1:N):** Um usuário pode escrever várias avaliações, mas cada avaliação pertence a um único usuário e um único anime.

## 3. Melhorias Estruturais Aplicadas

1.  **Desacoplamento de Gêneros:** Originalmente os gêneros eram arrays estáticos. A modelagem agora permite filtros dinâmicos e expansão de categorias sem alterar a estrutura da tabela principal.
2.  **Integridade Referencial:** Uso de `FOREIGN KEY` com `ON DELETE CASCADE` para garantir que, ao remover um usuário ou anime, seus dados relacionados (favoritos, avaliações) sejam limpos automaticamente.
3.  **Restrições de Unicidade:** Garantia de que e-mails não se repitam (`unique`) e que um usuário não possa avaliar o mesmo anime duas vezes (índice único em `reviews`).

## 4. Tecnologias Recomendadas

*   **SQLite:** Recomendado para o desenvolvimento local e prototipagem rápida (utilizado atualmente no projeto).
*   **MySQL/PostgreSQL:** Recomendado para ambiente de produção, suportando maior concorrência e escalabilidade.
*   **Repository Pattern:** A estrutura está preparada para ser consumida via classes Repository (ex: `AnimeRepository.php`), isolando a lógica SQL das regras de negócio.

---

*Gerado para a atividade: Arquitetura de Dados: Modelagem Relacional e Documentação com DBML*
