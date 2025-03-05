# TodoApp - Gestionnaire de Tâches avec API REST

## Description
TodoApp est une application simple de gestion de tâches qui permet aux utilisateurs de créer, lire, mettre à jour et supprimer des tâches. L'application dispose d'une interface utilisateur intuitive et d'une API REST pour l'accès aux données.

## Fonctionnement

### Installation
Pour installer l'application, clonez le dépôt et installez les dépendances :
```bash
git clone https://github.com/Fvrenn/Toodo1pp.git
cd TodoApp
npm install
```

### Configuration de la base de données
Modifiez le fichier `.env` pour configurer votre connexion à la base de données :

Créez la base de données et exécutez les migrations :

### Utilisation
Pour démarrer l'application en environnement de développement, exécutez la commande suivante :
```bash
symfony server:start
```

Accédez à l'application via : [http://localhost:8000/task/](http://localhost:8000/task/)

### Fonctionnalités
- **Créer une tâche** : Ajoutez une nouvelle tâche avec un titre et une description.
- **Lire les tâches** : Affichez toutes les tâches existantes dans une interface Kanban.
- **Mettre à jour une tâche** : Modifiez le titre ou la description d'une tâche existante.
- **Supprimer une tâche** : Supprimez une tâche de la liste.
- **Changer le statut** : Marquez une tâche comme en cours ou terminée.
- **Interface Kanban** : Visualisez vos tâches organisées par statut.
- **API REST** : Accédez aux données via des endpoints API.

### Technologies utilisées
- Symfony 6 : Framework PHP
- Doctrine ORM : ORM pour la gestion de la base de données
- Twig : Moteur de templates
- Tailwind CSS : Framework CSS pour le design
- MySQL/MariaDB : Base de données relationnelle
- API REST : Accès aux données au format JSON

## API REST
L'application propose une API REST pour accéder aux données des tâches. Voici les endpoints disponibles :

1. **Récupérer toutes les tâches**
    - Méthode : GET
    - URL : `/api/tasks`
    - Réponse : Liste de toutes les tâches

2. **Récupérer les tâches filtrées**
    - Méthode : GET
    - URL : `/api/tasks?filter=pending` ou `/api/tasks?filter=completed`
    - Paramètres : `filter` (values: `pending`, `completed`)
    - Réponse : Liste des tâches filtrées

3. **Récupérer une tâche spécifique**
    - Méthode : GET
    - URL : `/api/tasks/{id}`
    - Réponse : Détails d'une tâche spécifique

4. **Créer une nouvelle tâche**
    - Méthode : POST
    - URL : `/api/tasks`
    - Corps de la requête : Données de la tâche au format JSON
    - Réponse : Confirmation de la création et données de la nouvelle tâche
    - Exemple de réponse :
      ```json
      {
         "status": "success",
         "message": "Tâche créée avec succès",
         "task": {
            "id": 3,
            "title": "Nouvelle tâche",
            "description": "Description de la nouvelle tâche",
            "status": false,
            "created_at": "2023-05-30T16:45:00+00:00"
         }
      }
      ```

## Contribuer
Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter des changements que vous souhaitez apporter.

## Licence
Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
