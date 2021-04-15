<div class="modal" tabindex="-1" role="dialog" id="cadastro">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="cadastro-form" method="post" action="/empresas/create">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastro de Empresas</h5>
                    <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close" onclick="hideModal();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="UF">UF:</label>
                        <select class="form-control" name="UF" required>
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
                    <div class="form-group mt-3">
                        <label for="CNPJ">CNPJ:</label>
                        <input class="form-control CNPJ" name="CNPJ" id="CNPJ" maxlength="14" required onkeypress="return somenteNumeros(event);" />
                    </div>
                    <div class="form-group mt-3">
                        <label for="NOMEFANTASIA">Nome Fantasia:</label>
                        <input class="form-control" name="NOMEFANTASIA" maxlength="255" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>