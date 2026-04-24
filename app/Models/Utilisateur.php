<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use  Laravel\Sanctum\HasApiTokens;


class Utilisateur extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $table="utilisateurs";
    protected $primaryKey="code_user";
    public $incrementing=false;
    protected $keyType="string";
    public $timestamps =true;
    protected $fillable=[
        "code_user",
        "nom_user",
        "prenom_user",
        "login_user",
        "password_user",
        "tel_user",
        "sexe_user",
        "role_user",
        "etat_user"

    ];

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'user_competence', 'code_user', 'code_comp'); // Assuming 'code_user' is the foreign key in the pivot table for the Utilisateur model and 'code_comp' is the foreign key for the Competence model
    }

    public function interventionsClient()
    {
        return $this->hasMany(Intervention::class, 'code_user_client', 'code_user');// assure que 'code_user_client' est le nom de la colonne dans la table 'interventions' qui fait référence à 'code_user' dans la table 'utilisateurs'
    }

    public function interventionsTechnicien()
    {
        return $this->hasMany(Intervention::class, 'code_user_techn', 'code_user');
    }
}
