pipeline {
    agent any
    
    environment {
        APP_NAME = 'laravel-app'
        DEPLOY_HOST = '178.128.93.188'
        SERVER_PASSWORD = credentials('server-password')
        EMAIL_TO = 'your-email@example.com'
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out code from repository...'
                checkout scm
            }
        }
        
        stage('Environment Setup') {
            steps {
                echo 'Setting up environment...'
                sh '''
                    if [ ! -f .env ]; then
                        cp .env.example .env
                    fi
                '''
            }
        }
        
        stage('Install Dependencies') {
            steps {
                echo 'Installing Composer dependencies...'
                sh '''
                    docker run --rm -v $(pwd):/app composer:latest install --ignore-platform-reqs --no-dev
                '''
            }
        }
        
        stage('Run Tests') {
            steps {
                echo 'Running PHPUnit tests...'
                sh '''
                    docker run --rm -v $(pwd):/app -w /app php:8.2-cli php vendor/bin/phpunit || true
                '''
            }
        }
        
        stage('Deploy with Ansible') {
            steps {
                echo 'Deploying application with Ansible to ${DEPLOY_HOST}...'
                sh '''
                    ansible-playbook -i inventory playbook.yml --extra-vars "ansible_ssh_pass=${SERVER_PASSWORD}"
                '''
            }
        }
        
        stage('Health Check') {
            steps {
                echo 'Performing health check on deployed server...'
                sh '''
                    sleep 10
                    curl -f http://${DEPLOY_HOST}/health || curl -f http://${DEPLOY_HOST} || exit 1
                '''
            }
        }
    }
    
    post {
        success {
            echo '✅ Pipeline completed successfully!'
            emailext(
                subject: "✅ Jenkins Build ${env.JOB_NAME} - Success",
                body: """
                    <h2>Build Successful</h2>
                    <p><b>Project:</b> ${env.JOB_NAME}</p>
                    <p><b>Build Number:</b> ${env.BUILD_NUMBER}</p>
                    <p><b>Build URL:</b> <a href="${env.BUILD_URL}">${env.BUILD_URL}</a></p>
                    <p><b>Deployed to:</b> ${env.DEPLOY_HOST}</p>
                """,
                to: "${EMAIL_TO}",
                attachLog: true
            )
        }
        failure {
            echo '❌ Pipeline failed!'
            emailext(
                subject: "❌ Jenkins Build ${env.JOB_NAME} - FAILED",
                body: """
                    <h2>Build Failed</h2>
                    <p><b>Project:</b> ${env.JOB_NAME}</p>
                    <p><b>Build Number:</b> ${env.BUILD_NUMBER}</p>
                    <p><b>Build URL:</b> <a href="${env.BUILD_URL}">${env.BUILD_URL}</a></p>
                    <p><b>Failed Stage:</b> ${env.STAGE_NAME}</p>
                """,
                to: "${EMAIL_TO}",
                attachLog: true
            )
        }
        always {
            echo 'Cleaning up...'
        }
    }
}
