<?php
  namespace Backend\Controllers;

  use Backend\Services\UsuarioService;
  use Backend\Models\Usuario;
  use Exception;

  class UsuarioController{
    private UsuarioService $service;

    public function __construct(UsuarioService $service){
      $this->service = $service;
    }

    public function login($data){
      try {
        if(is_array($data)) {
          $data = (object) $data;
        }

        $response = $this->service->login($data->usuario, $data->password);
        if($response){
          echo json_encode([
            'message' => 'success',
            'data' => $response
          ]);
        }else{
          echo json_encode([
            'message' => 'error',
            'error' => 'Credenciales Inválidas'
          ]);
        }
      }catch(Exception $e){
        echo json_encode([
          'message' => 'error',
          'error' => $e->getMessage()
        ]);
      }
    }
  }
?>