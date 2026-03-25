/**
 * MINI FRAMEWORK PARA INDEXEDDB (db.js)
 * Gerenciamento de banco de dados local no navegador.
 */

const DB_NOME = 'AnimeRateDB';
const DB_VERSAO = 1;
const STORE_NOME = 'avaliacoes';

/**
 * Inicia o banco de dados e cria a store se não existir.
 */
function iniciarBanco() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NOME, DB_VERSAO);

        request.onupgradeneeded = (event) => {
            const db = event.target.result;
            if (!db.objectStoreNames.contains(STORE_NOME)) {
                // Cria a store com id auto-incrementável
                db.createObjectStore(STORE_NOME, { keyPath: 'id', autoIncrement: true });
            }
        };

        request.onsuccess = (event) => resolve(event.target.result);
        request.onerror = (event) => reject('Erro ao abrir banco: ' + event.target.error);
    });
}

/**
 * Adiciona um novo item ao banco de dados.
 */
async function adicionarItem(dado) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NOME], 'readwrite');
        const store = transaction.objectStore(STORE_NOME);
        const request = store.add(dado);

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao adicionar item: ' + request.error);
    });
}

/**
 * Busca todos os itens salvos na store.
 */
async function buscarItens() {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NOME], 'readonly');
        const store = transaction.objectStore(STORE_NOME);
        const request = store.getAll();

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject('Erro ao buscar itens: ' + request.error);
    });
}

/**
 * Deleta um item pelo seu ID único.
 */
async function deletarItem(id) {
    const db = await iniciarBanco();
    return new Promise((resolve, reject) => {
        const transaction = db.transaction([STORE_NOME], 'readwrite');
        const store = transaction.objectStore(STORE_NOME);
        const request = store.delete(id);

        request.onsuccess = () => resolve(true);
        request.onerror = () => reject('Erro ao deletar item: ' + request.error);
    });
}
