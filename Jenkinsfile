pipeline {
    agent { label 'Agent1' }

    environment {
        CHAT_ID = '1080222391' 
    }

    stages {
        stage('Clone') {
            steps {
                git branch: 'laravel',
                    url: 'https://github.com/SothPichPanha/Devop.git'
            }
        }

        stage('Build') {
            steps {
                sh '''
                composer install
                cp .env.example .env || true
                php artisan key:generate
                '''
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                ansible-playbook playbook.yml -i inventory.ini
                '''
            }
        }
    }

    post {

        success {
            script {
                def msg = """
            *Build Success*
            
            Job: ${env.JOB_NAME}
            Build: #${env.BUILD_NUMBER}
            Branch: laravel
            Time: ${new Date().format("yyyy-MM-dd HH:mm:ss")}
            
            Open Build:
            ${env.BUILD_URL}
            """

                withCredentials([string(credentialsId: 'telegram-token', variable: 'TOKEN')]) {
                    httpRequest(
                        url: "https://api.telegram.org/bot${TOKEN}/sendMessage",
                        httpMode: 'POST',
                        contentType: 'APPLICATION_FORM',
                        requestBody: "chat_id=${CHAT_ID}&text=${msg}"
                    )
                }
            }
        }

failure {
    script {
        echo "FAILURE TRIGGERED"

        def msg = "Build Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}"

        withCredentials([string(credentialsId: 'telegram-token', variable: 'TOKEN')]) {
            def res = httpRequest(
                url: "https://api.telegram.org/bot${TOKEN}/sendMessage",
                httpMode: 'POST',
                contentType: 'APPLICATION_FORM',
                requestBody: "chat_id=${CHAT_ID}&text=${msg}",
                validResponseCodes: '100:599'
            )

            echo "Status: ${res.status}"
            echo "Response: ${res.content}"
        }
    }
}

        unstable {
            script {
                def msg = "Build Unstable: ${env.JOB_NAME} #${env.BUILD_NUMBER}"

                withCredentials([string(credentialsId: 'telegram-token', variable: 'TOKEN')]) {
                    httpRequest(
                        url: "https://api.telegram.org/bot${TOKEN}/sendMessage",
                        httpMode: 'POST',
                        contentType: 'APPLICATION_FORM',
                        requestBody: "chat_id=${CHAT_ID}&text=${msg}"
                    )
                }
            }
        }
    }
}