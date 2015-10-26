<?php
class ContactTableSeeder extends Seeder {
  public function run()
  {
    DB::table('tab_contact')->delete(); #apaga todos os registros da tabela 'users'
    Contact::create([
        'name' => 'Marcos colombelli',
      'email' => 'marcos.colombelli@gmail.com',
  		'subject' => 'Um assunto qualquer',
  		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque saepe, reprehenderit voluptate nesciunt, iste beatae voluptates cum in minima id quam eligendi ea laudantium nam deleniti eaque, eveniet amet odio.',
    ]);
    Contact::create([
      'name' => 'Marco Deritti',
  		'email' => 'marco@doisms.com',
      'subject' => 'Um assunto qualquer',
  		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque saepe, reprehenderit voluptate nesciunt, iste beatae voluptates cum in minima id quam eligendi ea laudantium nam deleniti eaque, eveniet amet odio.',
    ]);
  }
}
?>