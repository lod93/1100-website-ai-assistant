# 1100-website-ai-assistant

This repository contains the code for integrating an AI assistant into the 1100.website hosting platform. The AI assistant helps customers by answering questions related to web hosting plans and recommending the best plan based on their needs.

## About 1100.website

1100.website is a leading provider of premium hosting solutions for businesses and individuals alike. Our mission is to offer reliable, secure, and cost-effective hosting options to our customers, backed by exceptional customer support. We utilize state-of-the-art technologies such as LiteSpeed Enterprise, JetBackup, Immunify360, and DirectAdmin Panel to deliver a seamless hosting experience that exceeds expectations.

## Features

- AI assistant for answering web hosting-related questions
- Recommendations based on customer needs
- User-friendly chat interface

## Technologies Used

- HTML, CSS, JavaScript for the front end
- PHP for the backend
- OpenAI API for natural language processing

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/lod93/1100-website-ai-assistant.git
    ```

2. Navigate to the project directory:
    ```bash
    cd 1100-website-ai-assistant
    ```

3. Set up your environment variables:
    - Rename `.env.example` to `.env`.
    - Add your OpenAI API key to the `.env` file:
        ```
        OPENAI_API_KEY=your-api-key-here
        ```

4. Deploy the files to your web server.

## Usage

1. Open the `index.html` file in your browser.
2. Interact with the AI assistant by typing your questions in the chat interface.

## File Structure

- `index.html`: The front-end chat interface.
- `ai-assistant.php`: The backend PHP script for processing user messages and interacting with the OpenAI API.
- `.env.example`: Example environment file for storing the OpenAI API key.

## Contributing

We welcome contributions! Please fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.
