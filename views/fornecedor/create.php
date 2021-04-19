<div class="modal" tabindex="-1" role="dialog" id="cadastro">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="cadastro-form" method="post" action="/fornecedores/create">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastro de Fornecedores</h5>
                    <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close" onclick="hideModal();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="EMPRESA" value="<?=$_REQUEST['empresa']?>" />
                    <div class="form-group mt-3">
                        <label for="CPFCNPJ">CPF / CNPJ:</label>
                        <input class="form-control" type="text" name="CPFCNPJ" id="CPFCNPJ" maxlength="14" required onkeypress="return somenteNumeros(event);" />
                        <div class="invalid-feedback">CPF inválido</div>
                    </div>
                    <div class="alert alert-danger d-none" role="alert"></div>
                    <div class="form-group mt-3">
                        <label for="NOME">NOME:</label>
                        <input class="form-control" type="text" name="NOME" maxlength="255" required />
                    </div>
                    <div class="form-group mt-3">
                        <label for="TELEFONE">TELEFONE:</label>
                        <input class="form-control" type="text" name="TELEFONE" id="TELEFONE" maxlength="15" required />
                    </div>
                    <div id="ADICIONALPF" style="display:none;">
                        <div class="form-group mt-3">
                            <label for="RG">RG:</label>
                            <input class="form-control" type="text" name="RG" id="RG" maxlength="50" />
                        </div>
                        <div class="form-group mt-3">
                            <label for="DATANASCIMENTO">DATA DE NASCIMENTO:</label>
                            <input class="form-control" type="date" name="DATANASCIMENTO" id="DATANASCIMENTO" maxlength="10" />
                        </div>
                    </div>
                    <div id="ADICIONALPJ" style="display:none;">
                        <div class="form-group mt-3">
                            <label for="UF">UF:</label>
                            <select class="form-control" name="UF" id="UF">
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                        <div class="form-group mt-3" id="INSCMUNICIPAL" style="display:none;">
                            <label for="INSCMUNICIPAL">INSCRIÇÃO MUNICIPAL:</label>
                            <input class="form-control" type="text" name="INSCMUNICIPAL" maxlength="50" />
                        </div>
                        <div class="form-group mt-3" id="INSCESTADUAL" style="display:none;">
                            <label for="INSCESTADUAL">INSCRIÇÃO ESTADUAL:</label>
                            <input class="form-control" type="text" name="INSCESTADUAL" maxlength="50" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>