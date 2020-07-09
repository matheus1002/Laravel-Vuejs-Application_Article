<template>

    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Artigos</div>

                    <div class="card-body">

                        <form @submit.prevent="adicionar" class="mb-3">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Título" v-model="artigo.titulo">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Descrição" v-model="artigo.descricao"></textarea>
                            </div>
                            <button class="btn btn-flat btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Salvar Artigo</button>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody v-for="artigo in artigos" v-bind:key="artigo.id">
                                <tr>
                                    <td>{{ artigo.id }}</td>
                                    <td>{{ artigo.titulo }}</td>
                                    <td>{{ artigo.descricao }}</td>
                                    <td style="width: 210px;">

                                        <button @click="editar(artigo)" class="btn btn-primary">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            Editar</button>

                                        <button @click="deletar(artigo.id)" class="btn btn-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Remover</button>

                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>

                    <div class="card-footer">
                        <nav>
                            <ul class="pagination" style="padding-left: 36%">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="listar(pagination.prev_page_url)">
                                        Anterior
                                    </a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">
                                        Página {{ pagination.current_page }} de {{ pagination.last_page }}
                                    </a>
                                </li>

                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="#" @click="listar(pagination.next_page_url)">
                                        Próximo
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                artigos: [],
                artigo: {
                    id: '',
                    titulo: '',
                    descricao: ''
                },
                artigo_id: '',
                pagination: {},
                edit: false
            }
        },

        created() {
            this.listar();
        },

        methods: {
            listar(page_url) {
                let vm = this;
                page_url = page_url || 'api/artigos';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                       this.artigos = res.data;
                       vm.paginacao(res.meta,res.links);
                    })
                    .catch(err => console.log(err));
            },
            paginacao(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            deletar(id) {
                if(confirm('Você tem certeza?')) {
                    fetch(`api/artigo/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Artigo removido');
                        this.listar();
                    })
                    .catch(err => console.log(err));
                }
            },
            adicionar() {
                if(this.edit === false) {
                    //Adicionar
                    fetch('api/artigo', {
                        method: 'post',
                        body: JSON.stringify(this.artigo),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.artigo.titulo = '';
                        this.artigo.descricao = '';
                        alert('Artigo Adicionado');
                        this.listar();
                    })
                    .catch(err => console.log(err));
                } else {
                    //Atualizar
                    fetch('api/artigo', {
                        method: 'put',
                        body: JSON.stringify(this.artigo),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.artigo.titulo = '';
                            this.artigo.descricao = '';
                            alert('Artigo Atualizado');
                            this.listar();
                        })
                        .catch(err => console.log(err));
                }
            },
            editar(artigo) {
                this.edit = true;
                this.artigo.id = artigo.id;
                this.artigo.artigo_id = artigo.id;
                this.artigo.titulo = artigo.titulo;
                this.artigo.descricao = artigo.descricao;
            }
        }
    }
</script>
