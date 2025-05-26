<?php

namespace App\Enums;

enum Status:string
{
    case ABERTA = 'Aberta';

    case ATENDIMENTO = 'Em Atendimento';

    case FINALIZADA = 'Finalizada';

    case CANCELADA = 'Cancelada';

}
