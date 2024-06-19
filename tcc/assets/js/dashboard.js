document.addEventListener('DOMContentLoaded', () => {
    fetchData();
});

function fetchData() {
    fetch('backend.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-alunos').innerText = data.totalAlunos;
            document.getElementById('total-chaves').innerText = data.totalChaves;
            document.getElementById('total-alunos-devolucao').innerText = data.totalAlunosDevolucao;
            document.getElementById('total-emprestimos').innerText = data.totalEmprestimos;
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
}
