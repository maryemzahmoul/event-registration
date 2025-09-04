GUIDE COMPLET DU PROJET DEVOPS - README.MD


#  Plateforme d'Inscription aux Événements - DevOps Project

##  Description
Déploiement automatisé d'une application web PHP/MySQL sur Kubernetes avec pipeline CI/CD complet.

## Architecture
- **Frontend** : PHP (Interface web)
- **Backend** : PHP (Traitement formulaires) 
- **Database** : MySQL (Persistent Volume)
- **Orchestration** : Kubernetes (Minikube)
- **CI/CD** : GitHub Actions

## Structure du Projet
event-registration/
├──  k8s/ # Configuration Kubernetes
│ ├── mysql-deployment.yaml # Déploiement MySQL
│ ├── php-deployment.yaml # Déploiement PHP
│ └── service.yaml # Services et exposition
├──  php-app/ # Application PHP
│ ├── index.php # Formulaire d'inscription
│ ├── submit.php # Traitement des données
│ ├── list.php # Liste des participants
│ ├── db.php # Connexion base de données
│ └── Dockerfile # Containerisation PHP
├──  init-db/ # Initialisation base de données
│ └── database.sql # Schéma et données initiales
└──  .github/workflows/ # Automatisation CI/CD
└── deploy.yml # Pipeline GitHub Actions



## Prérequis
### 1. Environnement de Développement
# developpement de plateforme via vs code
# VM Ubuntu 20.04/22.04 LTS
# Minimum 4GB RAM, 2 CPU, 20GB disk
# accés internet et push 
### 2. Installation des Outils
 Docker
 Kubectl
 Minikube
 Git

### 3. construction des conteneurs et d'image Docker
 # Image PHP Application
docker build -t votre-username/event-registration:latest ./php-app
docker push votre-username/event-registration:latest
 # Image MySQL
docker pull mysql:8.0

### 4. Déploiement Manuel
# Démarrer le Cluster Kubernetes
minikube start --driver=docker --memory=4000 --cpus=2
# Créer le Namespace
kubectl create namespace php-mysql
# Déployer l'Application
  # Déployer MySQL
kubectl apply -f k8s/mysql-deployment.yaml -n php-mysql

  # Déployer PHP
kubectl apply -f k8s/php-deployment.yaml -n php-mysql

  # Vérifier le déploiement
kubectl get all -n php-mysql
### 4. Accéder à l'Application
bash
minikube service php-service -n php-mysql --url
# ➡️ http://192.168.49.2:30080

 
## Pipeline CI/CD Automatisé - Solution Optimisée
  Configuration GitHub Actions Révisée
### Problème Rencontré :
Impossible d'établir une connexion directe entre GitHub Actions et le cluster local en raison de contraintes réseau et de difficultés avec la configuration Kubeconfig.

### Solution Implémentée :
Création d'un cluster Kubernetes temporaire isolé dans le pipeline, garantissant une automatisation complète .

🔧 Secrets Requis dans GitHub
DOCKER_USERNAME:
DOCKER_PASSWORD: 
# Note : KUBECONFIG non requis avec la nouvelle approche

### Processus d'Automatisation
Déclenchement : À chaque push sur la branche main

Environnement : Création d'un cluster Minikube éphémère

Build : Construction automatique de l'image Docker

Déploiement : Installation sur le cluster temporaire

Validation : Tests automatisés de fonctionnalité

Nettoyage : Destruction du cluster après exécution

 # Preuve de Fonctionnement
Les logs GitHub Actions montrent :

✅ Création du cluster temporaire (minikube start)

✅ Build réussi de l'image Docker

✅ Déploiement Kubernetes 

✅ Apparition des nouveaux pods dans le workflow

✅ Tests de validation passés

✅ Nettoyage automatique (minikube delete)

  Tests Automatisés Intégrés

# Avantages de Cette Solution
Sécurité : Isolation complète des environnements

Portabilité : Indépendance de l'infrastructure locale

Reproductibilité : Environnement consistent à chaque exécution

Transparence : Logs détaillés disponibles dans GitHub Actions



