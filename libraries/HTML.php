<?php

namespace Eprom;

class HTML
{
    public static function tabelaCategorias($categorias, $nivel = 0)
    {
        foreach ($categorias as $categoria)
        {
            echo '<tr>';
            echo '<td>'.str_repeat("&nbsp;", ($nivel * 8)).$categoria->descricao.'</td>';
            echo '<td>'.
                \HTML::decode(\HTML::link('admin/categorias/'.$categoria->id, '<i class="glyphicon glyphicon-list-alt"></i>&nbsp;')).
                \HTML::decode(\HTML::link('admin/categorias/'.$categoria->id.'/editar', '<i class="glyphicon glyphicon-pencil"></i>&nbsp;')).
                \HTML::decode(\HTML::link('admin/categorias/'.$categoria->id.'/excluir', '<i class="glyphicon glyphicon-remove"></i>'))
                .'</td>';
            echo '</tr>';

            if($categoria->filhos) {
                self::tabelaCategorias($categoria->filhos, ($nivel + 1));
            }
        }
    }

    public static function selectCategorias($categorias, $nivel = 0, $selected = 0)
    {
        if($categorias) {

            foreach ($categorias as $categoria)
            {
                if($categoria->id == $selected) {
                    echo "<option value=".$categoria->id." selected>".str_repeat("&nbsp;", ($nivel * 4)).$categoria->descricao."</option>";
                } else {
                    echo "<option value=".$categoria->id.">".str_repeat("&nbsp;", ($nivel * 4)).$categoria->descricao."</option>";
                }

                if($categoria->filhos) {

                    self::selectCategorias($categoria->filhos, ($nivel + 1), $selected);
                }
            }

        } elseif(!$categorias && $nivel == 0) {
            echo '<option value="0">Não existem categorias</option>';
        }
    }
}