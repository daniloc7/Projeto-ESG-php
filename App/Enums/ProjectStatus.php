<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case EM_PROGRESSO = 'em_progresso';
    case  FINALIZADO = 'finalizado';
    case  SUCESSO = 'sucesso';
    case  FALHA = 'falha';
}
