import pygame
import math
import random

NORTH = -2
EAST = 1
WEST = -1
SOUTH = 2

pygame.init()

#pygame essentials
winW = 500
winH = 500
screen = pygame.display.set_mode((winW, winH))
timer = pygame.time.Clock()

# global grid or map of the game
gridX = 50
gridY = 50
gridH = 30
gridW = 30
gridCols = 15
gridRows = 15
grid = [[0 for x in range(gridCols)]for y in range(gridRows)]
borderT = 2
cellW = math.floor((winW-gridX*2)/gridCols)
cellH = math.floor((winH -gridY*2)/gridRows)
cellColor = (100,255,100)

#snake vals
snakeLength = 2
snakeHead = 11
headX = 3
headY = 3
snakeColor = (255,25,25)
snakeDir = EAST
grid[3][3] = 11 #snake head starting position
grid[10][10] = 1 #food
foodColor = (255,255,25)

screen.fill((25,150,25))

isRunning = True

def drawBorderedBox(surface, col, rect, border = 1, bCol = (0,0,0)):
    bX = rect[0]
    bY = rect[1]
    bW = rect[2]
    bH = rect[3]
    bB = border
    pygame.draw.rect(surface, bCol, (bX,bY,bW,bH), bB)
    pygame.draw.rect(surface, col, (bX+bB,bY+bB,bW-(bB*2),bH-(bB*2)))

def handleEvents():
    global isRunning
    global snakeDir
    for event in pygame.event.get():
        if(event.type == pygame.QUIT):
            isRunning = False
        elif(event.type == pygame.KEYDOWN):
            key = event.key
            if(key == pygame.K_q):
                isRunning = False
            elif(key == pygame.K_a):
                if(abs(WEST) != abs(snakeDir)):
                    snakeDir = WEST
            elif(key == pygame.K_d):
                if(abs(EAST) != abs(snakeDir)):
                    snakeDir = EAST
            elif(key == pygame.K_w):
                if(abs(NORTH) != abs(snakeDir)):
                    snakeDir = NORTH
            elif(key == pygame.K_s):
                if(abs(SOUTH) != abs(snakeDir)):
                    snakeDir = SOUTH

def update():
    checkCollision()
    growSnake()
    
def playerLose():
    print("player Lose.")
    global headX, headY, snakeLength
    snakeLength = 2
    headX = 3
    headY = 3
    global isRunning 
    #isRunning = False

def checkCollision():
    global headX, headY
    moveX = 0
    moveY = 0
    
    if(abs(snakeDir) == 1):
        moveX = snakeDir
    else:
        moveY = math.floor(snakeDir/2)

    if(
        ((headX + moveX) < 0 or (headX + moveX) >= gridCols) or
        ((headY + moveY) < 0 or (headY + moveY) >= gridRows)
        ):
        playerLose()
        return -1
    elif(grid[headY+moveY][headX+moveX] > 10):
        playerLose()
        return -2
    elif(grid[headY+moveY][headX+moveX] > 0):
        snakeEat()
        
    
    headX += moveX
    headY += moveY
    grid[headY][headX] = snakeHead
    
    return 0

def snakeEat():
    global snakeLength
    snakeLength += 1
    while(True):
        fx = random.randint(0,gridCols-1)
        fy = random.randint(0,gridRows-1)
        if(grid[fy][fx] == 0):
            grid[fy][fx] = 1
            break

def growSnake():
    for y in range(gridCols):
        for x in range(gridRows):
            if(grid[y][x] >= snakeHead):
                if(grid[y][x] >= snakeHead + snakeLength):
                    grid[y][x] = 0
                else:
                    grid[y][x] += 1
            


def drawGrid():
    cellCol = cellColor
    for y in range(gridCols):
        for x in range(gridRows):
            if(grid[y][x] > 10):
                cellCol = snakeColor
            elif(grid[y][x] > 0):
                cellCol = foodColor
            else:
                cellCol = cellColor
            
            drawBorderedBox(screen, cellCol, (x*cellW+gridX,y*cellH+gridY,cellW,cellH))


def snake():
    while(isRunning):
        handleEvents()
        update()
        drawGrid()
        
        pygame.display.flip()
        
        
        timer.tick(5)

pygame.display.flip()

snake()

pygame.quit()