#include <iostream>
#include <bits/stdc++.h>
#include <cstdlib>
#include <time.h>

using namespace std;

#define endl '\n';
//#define __EXAMPLE__

#ifdef __linux__
    #ifndef __COLORS__
    #define __COLORS__

        #define BLK "\e[0;30m"
        #define RED "\e[0;31m"
        #define GRN "\e[0;32m"
        #define YEL "\e[0;33m"
        #define BLU "\e[0;34m"
        #define MAG "\e[0;35m"
        #define CYN "\e[0;36m"
        #define WHT "\e[0;37m"

        #define RESET "\e[0m"
    #endif

#else
    #define RESET ""
#endif

void print_child_table(vector<vector<int>> child, const int n) {
    for (int i=0; i<n; i++) {
        printf("Node: %d - [ ", i);
        for (int j=0; j<child[i].size(); j++) {
            if (child[i][j] != -1) {
                printf("%d ", child[i][j]);
            }
        }
        printf("]\n");
    }
}

void print_tree(string *buffer, const string prefix, const string children_prefix, const int node[], const int children[], 
                const vector<vector<int>> child, const int current_node_index, const int max_sum_starting_index, const bool mark_next,
                const vector<pair<int, int>> max_path) {
    *buffer += prefix;
    #ifdef __linux__
        const char *color = (current_node_index == max_sum_starting_index ? RED : (mark_next ? GRN : ""));
    #else
        const char *color = "";
    #endif
    *buffer += (color + to_string(current_node_index) + " (" + to_string(node[current_node_index]) + ")" + RESET);
    *buffer += endl;

    int children_count = children[current_node_index];
    for (int i=0; i<children_count; i++) {
        
        if (i < children_count-1) {
            string new_prefix = children_prefix + "├── ";
            string new_child_prefix = children_prefix + "│   ";

            const bool color_next = (current_node_index == max_sum_starting_index && (max_path[current_node_index].first == child[current_node_index][i] || max_path[current_node_index].second == child[current_node_index][i])) || (mark_next && max_path[current_node_index].first == child[current_node_index][i]);

            print_tree(buffer, new_prefix, new_child_prefix, node, children, child, child[current_node_index][i], max_sum_starting_index, color_next, max_path);
        }
        else {
            string new_prefix = children_prefix + "└── ";
            string new_child_prefix = children_prefix + "    ";

            const bool color_next = (current_node_index == max_sum_starting_index && (max_path[current_node_index].first == child[current_node_index][i] || max_path[current_node_index].second == child[current_node_index][i])) || (mark_next && max_path[current_node_index].first == child[current_node_index][i]);

            print_tree(buffer, new_prefix, new_child_prefix, node, children, child, child[current_node_index][i], max_sum_starting_index, color_next, max_path);
        }
    }
}

void calculate_dp(vector<pair<int, int>> &dp, vector<pair<int, int>> &max_path, const int node[], const int children[], const vector<vector<int>> child, const int current_node_index) {

    if (children[current_node_index] == 0) {
        dp[current_node_index].first = node[current_node_index];
        dp[current_node_index].second = node[current_node_index];
        return;
    }

    for (int i=0; i<children[current_node_index]; i++) {
        calculate_dp(dp, max_path, node, children, child, child[current_node_index][i]);
    }

    int max1 = -1;
    int max1_index = -1;

    for (int i=0; i<children[current_node_index]; i++) {
        if (dp[child[current_node_index][i]].first > max1) {
            max1 = dp[child[current_node_index][i]].first;
            max1_index = child[current_node_index][i];
        }
    }

    assert(max1_index != -1);

    int max2 = -1;
    int max2_index = -1;

    if (children[current_node_index] > 1) {
        for (int i=0; i<children[current_node_index]; i++) {
            if (child[current_node_index][i] != max1_index) {

                if (dp[child[current_node_index][i]].first > max2) {
                    max2 = dp[child[current_node_index][i]].first;
                    max2_index = child[current_node_index][i];
                }
            }
        }
    }

    int linear_max = max1 + node[current_node_index];
    int cyclic_max = max1 + max2 + node[current_node_index];

    assert(dp[current_node_index].first == -1);
    assert(dp[current_node_index].second == -1);

    dp[current_node_index].first = linear_max;
    dp[current_node_index].second = cyclic_max;

    max_path[current_node_index].first = max1_index;
    max_path[current_node_index].second = max2_index;
}

typedef struct node {
    struct node *left;
    struct node *right;

    int index;
    int weight;
}
node;

typedef struct binary_tree {
    node *root;
}
binary_tree;

void insert(binary_tree *tree, const int element, size_t *index_counter) {

    if (tree->root == NULL) {
        tree->root = (node *) malloc(sizeof(node));
        tree->root->index = 0;
        *index_counter = 1;
        tree->root->weight = element;
        return;
    }

    node *current = tree->root;

    while (1) {

        if (element >= current->weight) {
            if (current->right == NULL) {
                current->right = (node *) malloc(sizeof(node));
                current = current->right;

                current->index = *index_counter;
                *index_counter = *index_counter + 1;
                current->weight = element;
                return;
            }
            else {
                current = current->right;
            }
        }
        else {
            if (current->left == NULL) {
                current->left = (node *) malloc(sizeof(node));
                current = current->left;

                current->index = *index_counter;
                *index_counter = *index_counter + 1;
                current->weight = element;
                return;
            }
            else {
                current = current->left;
            }
        }
    }
}

void inorder(node *n, int *node, int *children, vector<vector<int>> &child) {

    if (n == NULL) {
        return;
    }

    inorder(n->left, node, children, child);

    node[n->index] = n->weight;
    children[n->index] = (n->left != NULL && n->right != NULL) + (n->left != NULL || n->right != NULL);

    if (children[n->index]) {
        child[n->index] = vector<int>(children[n->index]);
    }

    int index = 0;
    if (n->left != NULL) {
        child[n->index][index++] = n->left->index;
    }
    if (n->right != NULL) {
        child[n->index][index++] = n->right->index;
    }

    assert(index == children[n->index]);

    inorder(n->right, node, children, child);
}

void convert_binarytree_into_arrays(const binary_tree *tree, int *node, int *children, vector<vector<int>> &child) {
    inorder(tree->root, node, children, child);
}

void print_dp(const vector<pair<int, int>> &dp) {
    for (int i=0; i<dp.size(); i++) {
        printf("Node %d : {%d %d}\n", i, dp[i].first, dp[i].second);
    }
}

int main(int argc, char **argv) {

    #ifdef __EXAMPLE__

        int node[] = {7, 1, 1, 10, 6, 420, 69, 2, 5, 3, 1, 50, 2, 9};
        int children[] = {3, 3, 0, 4, 0, 0, 2, 0, 0, 1, 0, 0, 0, 0};

        int n = sizeof(node)/sizeof(int);
        assert(n == sizeof(children)/sizeof(int));

        vector<vector<int>> child(n);
        child[0] = {1, 2, 3};
        child[1] = {4, 5, 6};
        child[3] = {7, 8, 9, 10};
        child[6] = {11, 12};
        child[9] = {13};
    
    #else

        if (argc != 2) {
            exit(1);
        }

        const int n = atoi(argv[1]);

        binary_tree *tree = (binary_tree *) malloc(sizeof(binary_tree));
        srand(time(NULL));

        size_t index_counter = 0;
        for (int i=0; i<n; i++) {
            insert(tree, rand() % 1000, &index_counter);
        }

        assert(index_counter == n);

        int node[n];
        int children[n];
        vector<vector<int>> child(n);

        convert_binarytree_into_arrays(tree, node, children, child);

    #endif

    time_t init = time(NULL);

    vector<pair<int, int>> dp(n);
    vector<pair<int, int>> max_path(n);
    for (int i=0; i<n; i++) {
        dp[i].first = -1;
        dp[i].second = -1;
        max_path[i].first = -1;
        max_path[i].second = -1;
    }

    calculate_dp(dp, max_path, node, children, child, 0);

    int best_sum = 0;
    int index = -1;

    for (int i=0; i<n; i++) {
        if (dp[i].second > best_sum) {
            best_sum = dp[i].second;
            index = i;
        }
    }

    time_t end = time(NULL);

    string *buffer = new string("");
    print_tree(buffer, "", "", node, children, child, 0, index, false, max_path);
    cout << *buffer << endl;
    delete buffer;

    cout << "Best sum: " << best_sum << " on subtree with root index: " << index << "\n";
    cout << "Execution time: " << (end - init) << " ms\n";

    return 0;
}